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

