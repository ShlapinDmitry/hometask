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
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;

class CatalogAutoTable extends DataManager {
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'my_module_catalog_auto_autos';
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
            
            new IntegerField(
                'ID_COMPLECTATION',
                [
                    'default_value' => 0,
                    'title' => 'ID_COMPLECTATION'
                ]
            ),
            
            (new Reference(
                    'COMPLECTATION',
                    CatalogComplactetionTable::class,
                    Join::on('this.ID_COMPLECTATION', 'ref.ID')
                ))
                ->configureJoinType('inner'),
            
            new IntegerField(
                'ID_MODEL',
                [
                    'default_value' => 0,
                    'title' => 'ID_MODEL'
                ]
            ),
            
            (new Reference(
                    'MODEL',
                    CatalogModelTable::class,
                    Join::on('this.ID_MODEL', 'ref.ID')
                ))
                ->configureJoinType('inner'),
            
            new StringField(
                'NAME',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateString'],
                    'title' => 'NAME'
                ]
            ),
            
            new IntegerField(
                'YEAR',
                [
                    'default_value' => 2022,
                    'title' => 'YEAR'
                ]
            ),
            
            new IntegerField(
                'PRICE',
                [
                    'default_value' => 0,
                    'title' => 'PRICE'
                ]
            ),
            
            (new ManyToMany('OPTIONS', CatalogOptionTable::class))
                ->configureTableName('my_module_catalog_auto_options_to_autos')
                ->configureLocalPrimary('ID', 'ID_AUTO')
                ->configureLocalReference('AUTO')
                ->configureRemotePrimary('ID', 'ID_OPTION')
                ->configureRemoteReference('OPTION')
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
