<?php

namespace AppBundle\Form;

use AppBundle\Model\Search;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Jérémy Lefebvre <jeremy2@widop.com>
 */
class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class)
            ->add('authorFilter', CheckboxType::class, [
                'data'     => true,
                'required' => false
            ])
            ->add('titleFilter', CheckboxType::class, [
                'data'     => true,
                'required' => false
            ])
            ->add('cityFilter', CheckboxType::class, [
                'data'     => true,
                'required' => false
            ])
            ->add('minPrice', NumberType::class, [
                'required' => false
            ])
            ->add('maxPrice', NumberType::class, [
                'required' => false
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class
        ]);
    }
}
