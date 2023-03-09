let $doctor, $date, $specialty, iRadio;
let $hoursMorning, $hoursAfternoon, $titleMorning, $titleAfternoon;

const titleMorning = `
En la mañana
`;

const titleAfternoon = `
En la tarde
`;

const noHours = `
<h5 class="text-danger">No hay horas disponibles</h5>
`;

$(function() {
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $titleMorning = $('#titleMorning');
    $hoursMorning = $('#hoursMorning');
    $titleAfternoon = $('#titleAfternoon');
    $hoursAfternoon = $('#hoursAfternoon');


    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/especialidades/${specialtyId}/medicos`;
        $.getJSON(url, onDoctorsLoaded);
    });


    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors) {
    let htmlOptions = ""
    doctors.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });

    $doctor.html(htmlOptions);
    loadHours();
}

function loadHours(){
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data){
    let htmlHoursM ='';
    let htmlHoursA ='';
    iRadio = 0;

    if (data.morning) {
        const morning_intervalos = data.morning;
        morning_intervalos.forEach(intervalo => {
            htmlHoursM += getRadioIntervaloHTML(intervalo);
        });
    }

    if (!htmlHoursM != "") {
        htmlHoursM += noHours;
    }

    if (data.afternoon) {
        const afternoon_intervalos = data.afternoon;
        afternoon_intervalos.forEach(intervalo => {
            htmlHoursA +=  getRadioIntervaloHTML(intervalo);
        });
    }

    if (!htmlHoursA != "") {
        htmlHoursA += noHours;
    }

    $hoursMorning.html(htmlHoursM);
    $hoursAfternoon.html(htmlHoursA);
    $titleMorning.html(titleMorning);
    $titleAfternoon.html(titleAfternoon);
}

function getRadioIntervaloHTML(intervalo) {
    const text = `${intervalo.start} - ${intervalo.end}`

    return `<div class="custom-control custom-radio mb-3">
            <input required type="radio" id="interval${iRadio}" name="scheduled_time" value="${intervalo.start}" class="custom-control-input" value="${text}">
            <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
            </div>`
}