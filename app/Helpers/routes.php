<?php

/**
 * Функции сокращения записи часто используемых маршрутов системы
 *
 */

/**
 * Прочие функции, связанные с роутингом
 *
 */

if (! function_exists('getResourceNames')) {
    /**
     * Создает массив имен роутинга для ресурсного контроллера.
     *
     */
    function getResourceNames(string $entity): array
    {
        return [
            'index'		=> "$entity.index",
            'create'	=> "$entity.create",
            'store'		=> "$entity.store",
            'show'		=> "$entity.show",
            'edit'		=> "$entity.edit",
            'update'	=> "$entity.update",
            'destroy'	=> "$entity.destroy",
        ];
    }
}
