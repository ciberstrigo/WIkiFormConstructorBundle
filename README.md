Установка 
============

### Шаг 1: Загрузка бандла

```console
$ git clone
```

### Шаг 2: Подключение бандла

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

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