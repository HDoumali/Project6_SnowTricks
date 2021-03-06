<?php

namespace ST\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('description', TextareaType::class)
        ->add('category', EntityType::class, array(
             'class' => 'STAppBundle:Category',
             'choice_label' => 'name',
             'multiple' => false
        ))
        ->add('pictures', CollectionType::class, array(
              'label' => 'Images',
              'entry_type' => PictureType::class,
              'allow_add' => true,
              'required' => false,
              'by_reference' => false,
              'data' => array()
        ))
        ->add('videos', CollectionType::class, array(
              'entry_type' => VideoType::class,
              'allow_add' => true,
              'required' => false,
              'by_reference' => false,
              'data' => array()
        ))
        ->add('save', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ST\AppBundle\Entity\Trick'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st_appbundle_trick';
    }
}
