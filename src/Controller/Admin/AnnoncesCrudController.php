<?php

namespace App\Controller\Admin;

use App\Entity\Annonces;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnnoncesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonces::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new ('agency');
        yield TextField::new('type');
        yield NumberField::new('surface');
        yield NumberField::new('rooms');
        yield NumberField::new('bedrooms');
        yield TextField::new('furnished');
        yield TextField::new('floor');
        yield NumberField::new('balcony');
        yield NumberField::new('patio');
        yield TextField::new('lift');
        yield NumberField::new('price');
        yield NumberField::new('guarantee');
        yield TextField::new('description');
        yield ImageField::new('image')
            ->setBasePath('assets/images')
            ->setUploadDir("public/assets/images");
        yield TextField::new('address');
        yield TextField::new('nickname');
        yield TextField::new('phone');
        yield SlugField::new ('slug')->setTargetFieldName('agency')->hideOnIndex();
        
        // yield TextField::new ('photo_url')->hideOnIndex();
        
        
        
        
            
        


    }
}
