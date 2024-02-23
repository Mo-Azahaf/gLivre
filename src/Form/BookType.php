<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn')
            ->add('title')
            ->add('resume')
            ->add('description')
            ->add('price', NumberType::class, [
                'constraints' => [
                    new GreaterThan([
                            'value' => 0,
                            'message' => " c'est pas gratuit ! "
                        ]
                    )
                ]
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' =>function (Author $author){
                    return $author->getFullName();
                } 
            ])
            ->add('editor', EntityType::class, [
                'class' => Editor::class,
                'choice_label' =>function (Editor $editor){
                    return $editor->getName();
                } 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
