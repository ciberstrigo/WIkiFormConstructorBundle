# WikFormConstructorBundle
Кастомные формы и их конструктор. 

## Установка 

### Шаг 1: Загрузка бандла

```console
$ cd {your_project_directory}/bundles/
$ git clone https://github.com/ciberstrigo/WikiFormConstructorBundle.git
```

### Шаг 2: Подключение бандла

Подключить бандл, добавив в список зарегистрированных пакетов 
в `config/bundles.php` вашего проекта:

```php
// config/bundles.php

return [
    // ...
    WikiFormConstructorBundle\WikiFormConstructorBundle::class => ['all' => true],
];
```

### Шаг 3: Прописать Routes

Добавить в config/routes.yml

```yaml
wiki_form_construction_bundle_annotations:
  # loads routes from the PHP annotations of the controllers found in that directory
  resource: '@WikiFormConstructorBundle/Controller'
  type:     annotation
```

### Шаг 4 (опционально): Переопределение полей сущностей

Все Entity внутри бандла объявлены c `@MappedSuperclass` аннотацией.   
https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/inheritance-mapping.html

## API методы

* [Get all created forms](apidoc/get-api-forms.md) : `GET /api/forms` or `GET /api/public/forms`
* [Create new form](apidoc/post-api-forms.md) : `POST /api/forms` or `POST /api/public/forms`
* [Update form](apidoc/put-api-forms-id.md) : `PUT /api/forms/{id}`   
* [Get form by id](apidoc/get-api-forms-id.md) : `GET /api/forms/{id}` or `GET /api/public/{id}`   
* [Get form version by id](apidoc/get-api-forms-getbyalias-alias-versions.md): `GET /api/forms/get_by_alias/{alias}/versions` or `GET /api/public/forms/get_by_alias/{alias}/versions`
* [Get form by alias](apidoc/get-api-forms-getbyalias-alias.md): `GET /api/forms/get_by_alias/{alias}` or `GET /api/public/forms/get_by_alias/{alias}`
* [Submit form](apidoc/post-api-forms-id-send.md): `POST /api/forms/{id}/send` or `POST /api/public/forms/{id}/send`  
* [Remove form](apidoc/get-api-forms-id-remove.md): `GET /api/forms/{id}/remove`
* [Get a special case of the completed form](apidoc/get-api-form-results-id.md) `GET /api/form_results/{id}`