<?php

namespace MoviesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MovieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ["label" => "Titre du film" ])
            ->add('genres', EntityType::class, [
                "class" => "MoviesBundle\Entity\Genre",
                "choice_label" => "name",
                "required" => true,
                "expanded" => true,
                "multiple"  => true])
            ->add('year', null ,["label" => "Année de production"])
            ->add('cast',null, ["label" => "Acteurs"])
            ->add('directors',null, ["label" => "Réalisateur"])
            ->add('writers',null, ["label" => "Auteurs"])
            ->add('plot',null, ["label" => "Histoire"])
            ->add('runtime',null, ["label" => "Durée"])
            ->add('submit', SubmitType::class, ["label" => "Soumettre"]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MoviesBundle\Entity\Movie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'moviesbundle_movie';
    }


}
