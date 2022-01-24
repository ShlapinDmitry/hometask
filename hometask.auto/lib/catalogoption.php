<?php

/**
 * Description of catalogautomodeltable
 *
 * @author dmitry
 */

namespace Hometask\Auto;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;

class CatalogOptionTable extends DataManager {
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'my_module_catalog_auto_options';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            
            new IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => 'ID'
                ]
            ),
            
            new StringField(
                'NAME',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateString'],
                    'title' => 'NAME'
                ]
            ),
            
            (new ManyToMany('AUTOS', CatalogAutoTable::class))
                ->configureTableName('my_module_catalog_auto_options_to_autos')
                ->configureLocalPrimary('ID', 'ID_OPTION')
                ->configureLocalReference('OPTION')
                ->configureRemotePrimary('ID', 'ID_AUTO')
                ->configureRemoteReference('AUTO'),
            
            (new ManyToMany('COMPLECTATIONS', CatalogComplactetionTable::class))
                ->configureTableName('my_module_catalog_auto_options_to_complectations')
                ->configureLocalPrimary('ID', 'ID_OPTION')
                ->configureLocalReference('OPTION')
                ->configureRemotePrimary('ID', 'ID_COMPLECTATION')
                ->configureRemoteReference('COMPLACTATION')
        ];
    }

    /**
     * Returns validators for string field.
     *
     * @return array
     */
    public static function validateString()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}
