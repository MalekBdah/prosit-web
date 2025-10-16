<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ référence
            ->add('ref', TextType::class, [
                'label' => 'Ref',
            ])

            // Champ titre du livre
            ->add('title', TextType::class, [
                'label' => 'Titre du livre',
            ])

            // Champ date de publication avec valeur par défaut aujourd'hui
            ->add('publicationDate', DateType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text', // calendrier moderne
                'data' => new \DateTime(), // valeur par défaut aujourd'hui
            ])

            // Champ catégorie sous forme de liste déroulante
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Science-Fiction' => 'Science-Fiction',
                    'Mystery' => 'Mystery',
                    'Autobiography' => 'Autobiography',
                ],
                'placeholder' => 'Sélectionnez une catégorie',
            ])

            // Sélection d’un auteur existant (affiche le username)
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'username', // afficher le username
                'label' => 'Auteur',
                'placeholder' => 'Sélectionnez un auteur',
            ]);
            $builder
    ->add('enabled', CheckboxType::class, [
        'label' => 'Activé',
        'required' => false, // non coché = false
    ])
    ->add('published', CheckboxType::class, [
        'label' => 'Publié',
        'required' => false, // non coché = false
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
