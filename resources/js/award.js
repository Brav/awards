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

            if (response.status)
            {
                 $this.removeClass("btn-primary")
                    .addClass("btn-danger")
                    .text("Remove Winner Status");
            }
            else
            {
                 $this.removeClass("btn-danger")
                    .addClass("btn-primary")
                    .text('Make Winner');
            }

        }
    });
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

            $("#award-nominations-table").html(data.html);
            $(paginationID).html(data.pagination);
        },
        "json"
    );
}

checkNumberOfAdditionalFields();
