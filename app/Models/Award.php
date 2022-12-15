<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Award extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
        'always_visible',
        'period_type',
        'starting_at',
        'ending_at',
        'options',
        'fields',
        'roles',
        'roles_can_access_for_nomination',
        'background',
    ];

    static $periods = [
        1 => 'monthly',
        2 => 'quarterly',
        3 => 'annual',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'starting_at'                     => 'datetime',
        'ending_at'                       => 'datetime',
        'options'                         => 'array',
        'fields'                          => 'array',
        'roles'                           => 'array',
        'background'                      => 'array',
        'roles_can_access_for_nomination' => 'array',
    ];

    /**
     * Formats data for insert
     *
     * @param array $data
     * @return array
     */
    public function formatData(array $data) :array
    {
        $format['options'] = [];
        $format['fields']  = [];

        $background = [
            'award'  => null,
            'winner' => null,
            'logo'   => null,
        ];

        $format['name']           = \trim(\strip_tags($data['name'], '<br><p><em><strong>'));
        $format['description']    = \trim(\strip_tags($data['description'],
            '<br><p><em><strong>'));
        $format['order']          = (int) $data['order'];
        $format['period_type']    = (int) $data['period_type'];
        $format['always_visible'] = false;

        $startingAt = \DateTime::createFromFormat('d/m/Y', $data['starting_at']);
        $endingAt   = \DateTime::createFromFormat('d/m/Y', $data['ending_at']);

        $format['starting_at'] = $startingAt->format('Y-m-d H:i:s');
        $format['ending_at']   = $endingAt->format('Y-m-d H:i:s');

        if(isset($data['always_visible']) && $data['always_visible'] === 'true')
        {
            $format['always_visible'] = true;
        }

        $format['options']['office_type'] = $data['office_type'];

        if($data['office_type'] === 'clinic')
        {
            $format['options']['clinic_managers_shown'] = $data['clinic_managers_shown'] ?? null;
        }

        if(isset($data['nominations']))
        {
            $format['options']['nominations']['categories'] = $data['nominations'];

            $nominationsCount = count($data['nominations']);

            $minimum = $data['number_of_nomination_to_select'];

            if($nominationsCount === 1 || $nominationsCount < $data['number_of_nomination_to_select'])
            {
                $minimum = 1;
            }

            $nominationText = \trim(\filter_var($data['nomination_category_text'], FILTER_SANITIZE_STRING));

            $nominationText = $data['nomination_category_text'] !== '' ?
                $data['nomination_category_text'] : 'Reason for nomination';

            $format['options']['nominations']['minimum'] = $minimum;
            $format['options']['nominations']['text']    = $nominationText;
        }

        if(isset($data['additional_field']))
        {
            foreach($data['additional_field'] as $field)
            {
                if($field !== '')
                {
                    $format['fields'][] = \filter_var($field, FILTER_SANITIZE_STRING);
                }
            }

            $fieldsMinimum = $data['number_of_fields_to_fill'] ?? 1;

            if($fieldsMinimum > count($data['additional_field']))
            {
                $fieldsMinimum = 1;
            }

            $format['options']['fields_minimum'] = $fieldsMinimum;
        }

        if(isset($data['roles']))
        {
            $format['roles'] = array_filter( $data['roles'], 'is_numeric');
        }


        $format['roles_can_access_for_nomination'] = null;

        if(isset($data['roles_can_access_for_nomination'])
            && ! \in_array('all', $data['roles_can_access_for_nomination']))
        {
            $format['roles_can_access_for_nomination'] =
            array_filter( $data['roles_can_access_for_nomination'], 'is_numeric');
        }

        if(!empty(\trim(strip_tags($data['award-footer-info']))))
        {
            $format['options']['award-footer-info'] = \trim(strip_tags($data['award-footer-info']));
        }

        $format['slug'] = Str::slug(strip_tags($data['name']), '_');

        if($data['background-award'] !== null && !request()->hasFile('background'))
        {
            $background['award'] = \filter_var($data['background-award'], FILTER_SANITIZE_STRING);
        }

        if($data['background-winner'] !== null && !request()->hasFile('background'))
        {
            $background['winner'] = \filter_var($data['background-winner'], FILTER_SANITIZE_STRING);
        }

        if($data['background-logo'] !== null && !request()->hasFile('logo'))
        {
            $background['logo'] = \filter_var($data['background-logo'], FILTER_SANITIZE_STRING);
        }

        if(request()->hasFile('background'))
        {
            $fileName = Str::random(16)  . '.png';

            $background['award']  = $fileName;
            $background['winner'] = $fileName;
        }

        if(request()->hasFile('logo'))
        {
            $background['logo'] = Str::random(16)  . '.png';
        }

        $format['background'] = $background;

        return $format;
    }

    /**
     * Get the nomination options for the award.
     *
     * @return string
     */
    public function getNominationsAttribute() :string
    {
        $text = '';

        if(!isset($this['options']['nominations']))
        {
            return "/";
        }

        $nominations = $this['options']['nominations'];

        $nominationCategories = NominationCategory::withTrashed()->find($nominations['categories']);

        if($nominationCategories->count())
        {
            $text .= 'Categories: ';
            foreach ($nominationCategories as $category)
            {
                $text .= $category->name .', ';
            }

            $text = \rtrim($text, ', ');

            $text .= '<br>';
        }

        $text .= 'Minimum number of nomination categories user needs to select: ' . $nominations['minimum'] . '<br>';

        $text .= 'Text: ' . $nominations['text'];


        return $text;
    }

    /**
     * Return formated period type
     *
     * @return string
     */
    public function getPeriodAttribute() :string
    {
        return \ucfirst(self::$periods[$this->period_type]);
    }

    /**
     * Get formated background link
     *
     * @return string|null
     */
    public function getAwardBackgroundLinkAttribute() :?string
    {
        $defaultBackground = 'media/images/bg-deafult-award.jpg';
        static $background = null;

        if(!$this->background)
        {
            if(!$background)
            {
                $background = Background::first();
            }

            if($background && $background->award)
            {
                return Storage::url('public/backgrounds/' . $background->award);
            }

            return $defaultBackground;
        }

        if(isset($this->background['award']))
        {
            return Storage::url('public/backgrounds/' . $this->background['award']);
        }

        return $defaultBackground;

    }

    /**
     * Get formated background link
     *
     * @return string|null
     */
    public function getWinnerBackgroundLinkAttribute() :?string
    {
        $defaultBackground = null;
        static $background = null;

        if(!$this->background)
        {
            if(!$background)
            {
                $background = Background::first();
            }

            if($background && $background->winner)
            {
                return Storage::url('public/backgrounds/' . $background->winner);
            }

            return $defaultBackground;
        }

        if(isset($this->background['winner']))
        {
            return Storage::url('public/backgrounds/' . $this->background['winner']);
        }

        return $defaultBackground;

    }

    /**
     * Get award logo for the home page
     *
     * @return string|null
     */
    public function getAwardLogoAttribute(): ?string
    {
        $logo = null;
        static $defaultLogo = null;

        if(!$defaultLogo)
        {
            $defaultLogo = Logo::first();
        }

        if(isset($this->background['logo']))
        {
            return Storage::url('public/logos/' . $this->background['logo']);
        }

        if(!$this->background)
        {

            if($logo && $logo->name)
            {
                return Storage::url('public/logos/' . $defaultLogo->name);
            }

        }

        if(!isset($this->background['logo']))
        {
            return Storage::url('public/logos/' . optional($defaultLogo)->name ?? '');
        }

        return $logo;
    }

    /**
     * Return link info for the award home page
     *
     * @return array
     */
    public function getAwardLinkAttribute() :array
    {
        static $roles = null;

        if(!$roles)
        {
            $roles = Roles::all();
        }

        $link = [
            'link'     => null,
            'linkText' => '',
            'isLink'   => false,
        ];

        if(!$this->roles_can_access_for_nomination)
        {
            return [
                'link'     => route('award-nominations.create', $this->slug),
                'linkText' => 'Click to nominate a colleague today',
                'isLink'   => true,
            ];
        }

        if($this->roles_can_access_for_nomination)
        {

            $roleText = '';

            $usedRoles = $roles->filter(function($item){
                return \in_array($item->id, $this->roles_can_access_for_nomination);
            });

            $roleText = \implode(',', $usedRoles->pluck('name')->toArray());

            $link['linkText'] = 'Nominated by ' . $roleText;

            if(Auth::guest())
            {
                $link['link'] = route('login', $this->slug);
                return $link;
            }

            if(Auth::user())
            {

                $link['isLink'] = true;
                $link['link']   = route('login', $this->slug);

                if(in_array(auth()->user()->role_id, $this->roles_can_access_for_nomination) ||
                auth()->user()->admin)
                {
                    $link['link'] =route('award-nominations.create', $this->slug);
                }

                return $link;
            }


        }

        return $link;
    }

    /**
     * Return award footer info text
     *
     * @return array|null
     */
    public function getAwardFooterInfoAttribute(): ?array
    {
        if(!isset($this->options['award-footer-info']))
            return [];

        return \explode(',', $this->options['award-footer-info']);
    }

    /**
     * Get all of the submittedNominations for the Award
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submittedNominations(): HasMany
    {
        return $this->hasMany(AwardNomination::class);
    }

}
