<?php

namespace App\Interfaces;

interface HorarioServiceInterface
{
    public function getAvailableIntervals($date, $doctor_id);
}
