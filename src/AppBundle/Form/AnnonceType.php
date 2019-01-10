<?php
/**
 * Created by PhpStorm.
 * User: MUD0
 * Date: 10/01/2019
 * Time: 11:26
 */

namespace AppBundle\Form;

use AppBundle\Entity\Annonce;
use AppBundle\Entity\Type;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'required'      => true,
                'label'         => 'Titre de l\'annonce',
            ))
            ->add('libelle', TextType::class, array(
                'required'      => true,
                'label'         => 'Label de l\'annonce',
            ))
            ->add('type', EntityType::class, array(
                'class'         => Type::class,
                'label'         => 'Type de livre',
                'placeholder'   => '(SF, Polar, ...)',
                'required'      => false,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.type', 'ASC');
                },
                'choice_label'  => 'type',
            ))
            ->add('author', TextType::class, array(
                'label'         => 'Auteur du livre :',
                'required'      => true,
            ))
            ->add('description', TextareaType::class, array(
                'required'      => true,
                'label'         => 'Description',
            ))
            ->add('city', TextType::class, array(
                'label'         => 'Ville :',
                'required'      => true,
            ))
            ->add('price', NumberType::class, array(
                'required'      => true,
                'label'         => 'Prix',
            ))
            ->add('Submit', SubmitType::class, array(
                'label'         => 'Envoyez'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Annonce::class,
        ));
    }

}