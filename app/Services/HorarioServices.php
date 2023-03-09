<?php

namespace App\Services;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\Horarios;
use Carbon\Carbon;

class HorarioServices implements HorarioServiceInterface
{
    private function getDayFromDate($date)
    {
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        /* Obtenemos a los doctores */

        /* Iniciamos la semana desde lunes ya que Carbon inicia la semana con el día domingo */
        $day = ($i == 0 ? 6 : $i - 1);

        return $day;
    }


    public function getAvailableIntervals($date, $doctorId)
    {
        $horario = Horarios::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $doctorId)
            ->first([
                'morning_start',
                'morning_end',
                'afternoon_start',
                'afternoon_end',
            ]);

        if (!$horario) {
            return [];
        }

        $morningIntervalos = $this->getIntervalos(
            $horario->morning_start,
            $horario->morning_end,
            $doctorId,
            $date
        );



        $afternoonIntervalos = $this->getIntervalos(
            $horario->afternoon_start,
            $horario->afternoon_end,
            $doctorId,
            $date
        );

        $data = [];

        $data['morning'] = $morningIntervalos;
        $data['afternoon'] = $afternoonIntervalos;

        return $data;
    }

    /* Obteniendo los intervalos de las horas */
    private function getIntervalos($start, $end, $doctorId, $date)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];

        while ($start < $end) {
            $intervalo = [];
            $intervalo['start'] = $start->format('g:i A');

            $exists = Appointment::where('doctor_id', $doctorId)
                ->where('scheduled_date', $date)
                ->where('scheduled_time', $start->format('H:i:s'))
                ->exists();


            $start->addMinutes(30);

            $intervalo['end'] = $start->format('g:i A');

            if (!$exists) {
                $intervalos[] = $intervalo;
            }
        }

        return $intervalos;
    }
}
