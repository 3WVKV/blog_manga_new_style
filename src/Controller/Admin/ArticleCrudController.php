<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\BlobImageField\BlobImageField;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }



    public function createEntity(string $entityFqcn)
    {
        $article = new Article();
        $article->setUser($this->getUser()); // Assimiler l'utilisateur connecté à la création de l'article

        return $article;
    }

    
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('title', 'Titre');

        yield SlugField::new('slug')->setTargetFieldName('title')
        ->setUnlockConfirmationMessage('Il est fortement recommandé d\'utiliser les slugs automatiques, mais vous pouvez les personnaliser')->hideOnIndex();

        yield ImageField::new('thumbnail', 'Miniature')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);

        yield AssociationField::new('category' , 'Categorie(s)')->setRequired(false);

        yield TextField::new('description', 'Description');

        yield TextEditorField::new('content', 'Contenu')->setFormType(CKEditorType::class);

        
    }


    
    
}




