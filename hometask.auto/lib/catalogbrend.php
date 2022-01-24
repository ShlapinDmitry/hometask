<?php

/**
 * Description of catalogautobrendtable
 *
 * @author dmitry
 */

namespace Hometask\Auto;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;

class CatalogBrendTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'my_module_catalog_auto_brends';
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
            
            (new OneToMany('MODELS', CatalogModelTable::class, 'BREND'))->configureJoinType('inner'),
            
            new StringField(
                'NAME',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateString'],
                    'title' => 'NAME'
                ]
            )
            
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
