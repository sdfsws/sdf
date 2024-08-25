<?php

namespace App\View\Components;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Illuminate\View\Component;

class FlightScheduleType extends AbstractType
{
    // Define any properties or methods you need
    public $someProperty;

    /**
     * Create a new component instance.
     *
     * @param mixed $someProperty
     * @return void
     */
    public function __construct($someProperty)
    {
        $this->someProperty = $someProperty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.flight-schedule-type'); // Ensure this view exists
    }
}
