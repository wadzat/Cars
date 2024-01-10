<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\UserCar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('owner', null, [
                'label' => 'Votre nom'
            ])
            ->add('text', null, [
                'label' => 'Description'
            ])
            ->add('photoFilename', null, [
                'label' => 'Photo'
            ])
            ->add('model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
                'label' => 'Modèle'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserCar::class,
        ]);
    }
}
