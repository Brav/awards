const officeType = $("[name=office_type]");
const nomination = $("#nomination")

const managersRelationMap = [
    "lead_vet",
    "practice_manager",
    "veterinary_manager",
    "gm_veterinary_operations",
    "general_manager",
    "gm_vet_services",
    "regional_manager",
    "other",
];

if(officeType.length)
{
    if ($("[name=office_type]:checked").val() === "clinic") {
        $("#clinic-managers").removeClass("d-none");
    }

    officeType.on("change", function (e) {
        $("#clinic-managers").addClass("d-none");

        if ($(this).val() === "clinic") {
            $("#clinic-managers").removeClass("d-none");
        }
    });
}

if(nomination.length)
{
    nomination.on('change', function(e){

        if($(this).val().length > 1)
        {
            $("#number_of_nomination_to_select").prop('readonly', false);
        }
        else
        {
            $("#number_of_nomination_to_select")
                .prop("readonly", true)
                .val(1);
        }

    })
}

$('body').on('click', '#add_field', function(e){

    let fieldID = $(".additional_field").length + 1;

    const template = `
        <div class="col additional_field"
            id="field-${fieldID}">
            <div class="form-group">
                <label for="additional_field_${fieldID}">Addition Field Name</label>
                <input type="text" name="additional_field[]" id="additional_field_${fieldID}" class="form-control">
            </div>
            <i class="fas fa-trash fa-sm remove_field"
            data-field="field-${fieldID}">Remove</i>
        </div>
    `;

    $("#fields").append(template);

    checkNumberOfAdditionalFields()

})

$("body").on("click", ".remove_field", function(e){

    let field = $(this).data('field')

    $(`#${field}`).remove()

    checkNumberOfAdditionalFields();
});

$("body").on("change", "#clinic_id", function () {
    setClinicManager();
});

$("body").on("change", "#department_id", function () {
    setDepartmantManager($(this));
});

$('body').on('change', '#awardCategory', function (e) {

    let $this = $(this)
    let url = $this.find('option:selected').data('url')

    if ($this.val() === 'select')
    {
        return;
    }

    getNominations(url, $("#selectYear").val());

});

$("body").on("change", "#selectYear", function (e) {

    let $this    = $(this);
    let category = $("#awardCategory");

    if (category.val() === "select")
    {
        alert('Please select category')
        $this.val('all')
        return;
    }

    getNominations(category.find('option:selected').data('url'), $this.val())

});

$("body").on("change", "#winnerStatus", function (e) {
    let $this = $(this);
    let category = $("#awardCategory");

    if (category.val() === "select") {
        alert("Please select category");
        $this.val("all");
        return;
    }

    getNominations(category.find("option:selected").data("url"), $this.val());
});

$("body").on("click", ".change-winner-status", function (e) {

    let $this = $(this)

    $.ajax({
        type: "PUT",
        url: $this.data('url'),
        dataType: "json",
        data: { _token: $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {

            let itemID = $this.data("id");

            if (response.status)
            {
                 $this.removeClass("btn-primary")
                    .addClass("btn-danger")
                    .text("Remove Winner Status");

                $(`#item-${itemID}`).find(".winner-show").removeClass('d-none');
            }
            else
            {
                 $this.removeClass("btn-danger")
                    .addClass("btn-primary")
                    .text('Make Winner');

                $(`#item-${itemID}`)
                    .find(".winner-show")
                    .addClass("d-none");

                $(`#item-${itemID}`).find(".winner-update").addClass("d-none");
                $(`#item-${itemID}`).find(".winner-remove").addClass("d-none");
            }

        }
    });
});

$("body").on("click", ".winner-show", function (e) {

    let $this = $(this);


    $("#bigBody").html($("#winners-create").html().trim());

    $("#bigBody").find('#name').val($this.data('name'));
    $("#bigBody").find("#clinic").val($this.data("clinic"));
    $("#bigBody").find("#clinic_id").val($this.data("clinicid"));
    $("#bigBody").find("#award").val($this.data("award"));
    $("#bigBody").find("#award_id").val($this.data("awardid"));
    $("#bigBody").find("#award_nomination_id").val($this.data("id"));

    $("#bigModal").modal("show");
});

$("body").on("click", ".winner-remove", function (e)
{
    let $this = $(this);

    if (!confirm('Are you sure you want to remove this form home page?')) {
        return;
    }

    $.ajax({
        type: "DELETE",
        url: $this.data("url"),
        dataType: "json",
        data: { _token: $('meta[name="csrf-token"]').attr("content") },
        success: function (response) {
            let itemID = $this.data("id");

            $(`#item-${itemID}`).find(".winner-show").removeClass("d-none");

            $(`#item-${itemID}`).find(".winner-remove").addClass("d-none");
            $(`#item-${itemID}`).find(".winner-update").addClass("d-none");
        },
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert("Something went wrong, please try refresh the page and try again");
    });
});

$("body").on("submit", "#winners-store", function (e) {

    e.preventDefault()

    let $this = $(this);

    let data = $this.serialize()

    $.ajax({
        type: "POST",
        url: $this.attr("action"),
        dataType: "json",
        data: data,
        success: function (response) {
            let itemID = $this.find("#award_nomination_id").val();

            $(`#item-${itemID}`).find(".winner-show").addClass("d-none");

            $(`#item-${itemID}`).find(".winner-update").removeClass("d-none");
            $(`#item-${itemID}`).find(".winner-remove").removeClass("d-none");

            $("#bigModal").modal("hide");
        },
    }).fail(function (jqXHR, textStatus, errorThrown) {
        let errors = Object.keys(jqXHR.responseJSON.errors)

        errors.forEach(element => {
            $(`.alert-${element}`).removeClass('d-none')
        });
    });
});

$("body").on("click", ".background-delete", function (e) {
    e.preventDefault();
    let $this = $(this);
    let id = $this.parent().attr("id");

    if(!confirm('Are you sure you want to delete this image?'))
    {
        return;
    }

    $.ajax({
        type: "DELETE",
        url: $this.data("url"),
        dataType: "json",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            file: $this.data("file"),
        },
        success: function (response) {
            $(`#${id}`).remove();
        },
    });
});

$("body").on("click", ".background-set", function (e) {

    e.preventDefault();

    let $this  = $(this);
    let id     = $this.parent().attr("id");
    let column = $this.data('column')

    $.ajax({
        type: "PUT",
        url: $this.data("url"),
        dataType: "json",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            file: $this.data("file"),
            column: column,
        },
        success: function (response) {
            $(`.background-set.${column}`).removeClass("d-none");
            $(`#${id}`).find(`.background-set.${column}`).addClass("d-none");

            $(`.${column}-default`).addClass('d-none')

            $(`#${id}`).find(`.${column}-default`).removeClass("d-none");

        },
    });
});

$("body").on("click", ".background-use", function (e) {

    e.preventDefault();

    let $this = $(this);
    let id    = $this.parent().attr("id");
    let type  = $this.data('type')

    $(`.background-use.${type}`).removeClass("d-none");
    $(`#${id}`).find(`.background-use.${type}`).addClass("d-none");

    $(`.background-image.${type}`).removeClass("border border-danger");
    $this.parent().addClass("border border-danger");

    $(`#background-${type}`).val($this.data('file'))
});

$('body').on('click', '#export', function (e)
{
    e.preventDefault()

    let $this = $(this)

    $.ajax({
        type: "GET",
        url: $this.attr("href"),
        xhrFields: {
            responseType: "blob",
        },
        data: {
            year: $("#selectYear").val(),
            status: $("#winnerStatus").val(),
        },
        success: function (result, status, xhr) {

            let disposition = xhr.getResponseHeader("content-disposition");
            let matches = /"([^"]*)"/.exec(disposition);
            let filename =
                matches != null && matches[1] ? matches[1] : `${$this.data('name')}.xlsx`;

            // The actual download
            let blob = new Blob([result], {
                type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            });
            let link = document.createElement("a");
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;

            document.body.appendChild(link);

            link.click();
            document.body.removeChild(link);
        },
    });
});

$(function () {
    let category = $("#awardCategory");

    if(category.length && category.val() !== 'select')
    {
        let url = category.find("option:selected").data("url");

        getNominations(url, $("#selectYear").val());
    }
});

function setClinicManager() {

    let clinic = $("#clinic_id");

    managersRelationMap.forEach((element) => {

        let option = clinic.find("option:selected").data(element);
        $(`#${element}`).val(option);

    });
}

function setDepartmantManager(element)
{
    $("#departmant_manager").val(
        element.find("option:selected").data("manager")
    );

}

function checkNumberOfAdditionalFields()
{
    let numberOfFields = $("#fields").find(".additional_field").length;

    $("#number_of_fields").removeClass("d-none")

    if (numberOfFields > 1)
    {
        $("#number_of_fields_to_fill").attr("readonly", false);
    }
    else
    {
         $("#number_of_fields_to_fill").attr("readonly", true);
    }

    if(!numberOfFields)
    {
        $("#number_of_fields").addClass("d-none");
    }
}

/**
 * Ajax call for fetching nominations
 *
 * @param {string} url
 * @param {integer} year
 */
function getNominations(url, year)
{
    $.get(
        url,
        {
            year: year,
            status: $("#winnerStatus").val(),
        },
        function (data, textStatus, jqXHR) {
            let paginationID = data.id
                ? `#pagination-${data.id}`
                : "#pagination";

            $("#award-nominations-table").empty().html(data.html);
            $(paginationID).html(data.pagination);
        },
        "json"
    );
}

checkNumberOfAdditionalFields();
