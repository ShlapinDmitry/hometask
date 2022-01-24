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
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;

class CatalogModelTable extends DataManager {
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'my_module_catalog_auto_models';
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
            
            (new OneToMany('COMPLACTATIONS', CatalogComplactetionTable::class, 'MODEL'))->configureJoinType('inner'),
            
            (new OneToMany('MODELS', CatalogAutoTable::class, 'MODEL'))->configureJoinType('inner'),
            
            new IntegerField(
                'ID_BREND',
                [
                    'default_value' => 0,
                    'title' => 'ID_BREND'
                ]
            ),
            
            (new Reference(
                    'BREND',
                    CatalogBrendTable::class,
                    Join::on('this.ID_BREND', 'ref.ID')
                ))
                ->configureJoinType('inner'),
            
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
