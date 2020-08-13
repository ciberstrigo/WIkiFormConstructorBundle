# Get a special case of the completed form
Get data from the completed form
**URL** : `/api/form_results/{id}`    
**Method**: `GET`   

## Success Response

**Code**: `200 OK`   
**Content example**:
```json
{
    "success": true,
    "code": 200,
    "message": "",
    "data": {
        "data": {
            "alias": "Istochnik",
            "public": false,
            "title": "Источник",
            "attributes": null,
            "sort": 0,
            "id": "032dc9b8-bf20-4ab9-8c5d-d547f142d7a9",
            "version": "1.1",
            "objects": [
                {
                    "id": "9dd8eddd-f2df-4dbe-89a9-9e549dd99f8d",
                    "title": "Источник",
                    "mask": "%Nazvanie%",
                    "alias": "Istochnik",
                    "multiple": false,
                    "fields": [
                        {
                            "linkedField": null,
                            "id": "d378b283-8cc4-4712-b7cc-65ad31f3974c",
                            "alias": "Nazvanie",
                            "title": "Название",
                            "type": "string",
                            "subtype": "text",
                            "settings": [],
                            "validation": [
                                {
                                    "class": "required"
                                }
                            ],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "6ae614e8-1207-4490-86d7-22470e1a8520",
                            "alias": "Kod_ChS",
                            "title": "Код ЧС",
                            "type": "string",
                            "subtype": "text",
                            "settings": [],
                            "validation": [
                                {
                                    "class": "required"
                                }
                            ],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "2c8c40fa-f2a0-4050-a7ee-3fe8f49fdd9f",
                            "alias": "Adres_resursa",
                            "title": "Адрес ресурса",
                            "type": "text",
                            "subtype": "text",
                            "settings": [],
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "b066172a-a5b6-4b13-bf61-3f1fff9f7933",
                            "alias": "Chastota_obnovleniya_dannyh",
                            "title": "Частота обновления данных",
                            "type": "text",
                            "subtype": "text",
                            "settings": [],
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "1c8b6cff-2149-4f8b-827f-65d5e44cd325",
                            "alias": "Tematika",
                            "title": "Тематика",
                            "type": "text",
                            "subtype": "text",
                            "settings": [],
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "009456fe-96bd-4710-9478-085db39b5360",
                            "alias": "Status",
                            "title": "Статус",
                            "type": "array",
                            "subtype": "select",
                            "settings": {
                                "values": [
                                    {
                                        "title": "Новый",
                                        "value": "Новый"
                                    },
                                    {
                                        "title": "В работе",
                                        "value": "В работе"
                                    },
                                    {
                                        "title": "В кафке (идет сбор)",
                                        "value": "В кафке (идет сбор)"
                                    },
                                    {
                                        "title": "Подключен",
                                        "value": "Подключен"
                                    }
                                ]
                            },
                            "validation": [
                                {
                                    "class": "required"
                                },
                                {
                                    "class": "required"
                                }
                            ],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "070c49bc-517e-4789-9fbf-8a062be85bc0",
                            "alias": "Adres_mikroservisa",
                            "title": "Адрес микросервиса",
                            "type": "text",
                            "subtype": "text",
                            "settings": [],
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "0bcffa3f-b776-4983-b7ad-176e69c0aa6b",
                            "alias": "Kommentarii",
                            "title": "Комментарий",
                            "type": "text",
                            "subtype": "textarea",
                            "settings": [],
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "4c297413-8d7b-4a59-a7e4-1ad7062026ca",
                            "alias": "Format_dannyh",
                            "title": "Формат данных",
                            "type": "array",
                            "subtype": "select",
                            "settings": {
                                "values": [
                                    {
                                        "title": "Бинарная сериализация по схеме AVRO",
                                        "value": "Бинарная сериализация по схеме AVRO"
                                    },
                                    {
                                        "title": "JSON",
                                        "value": "JSON"
                                    },
                                    {
                                        "title": "PDF",
                                        "value": "PDF"
                                    },
                                    {
                                        "title": "TXT",
                                        "value": "TXT"
                                    },
                                    {
                                        "title": "CSV",
                                        "value": "CSV"
                                    }
                                ]
                            },
                            "validation": [],
                            "readOnly": false,
                            "multiple": true,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "9e0f0a6c-81df-4e74-9bc0-2e9564ed4c5e",
                            "alias": "Otvetstvennyi",
                            "title": "Ответственный",
                            "type": "object",
                            "subtype": "link",
                            "settings": {
                                "linked_object_type_id": "c630742c-0d48-4bb4-b315-3c88127ed090"
                            },
                            "validation": [],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        },
                        {
                            "linkedField": null,
                            "id": "7934d3b3-b486-47a6-8120-be91a473211e",
                            "alias": "Prioritet",
                            "title": "Приоритет",
                            "type": "array",
                            "subtype": "select",
                            "settings": {
                                "values": [
                                    {
                                        "title": "Низкий",
                                        "value": "Низкий"
                                    },
                                    {
                                        "title": "Средний",
                                        "value": "Средний"
                                    },
                                    {
                                        "title": "Высокий",
                                        "value": "Высокий"
                                    }
                                ]
                            },
                            "validation": [
                                {
                                    "class": "required"
                                },
                                {
                                    "class": "required"
                                }
                            ],
                            "readOnly": false,
                            "multiple": false,
                            "default_value": null
                        }
                    ],
                    "semantic_subclasses": [],
                    "updated_at": null,
                    "created_at": "2020-06-25T14:56:39+03:00"
                }
            ],
            "created_at": "07.07.2020 20:17:54"
        },
        "relations": [],
        "values": {
            "Istochnik/Istochnik": [
                {
                    "Nazvanie": "РусГидро",
                    "Kod_ChS": "5.2.2 Опасность маловодий",
                    "Adres_resursa": "http://www.rushydro.ru/hydrology/informer",
                    "Chastota_obnovleniya_dannyh": "каждые 24 часа",
                    "Tematika": "",
                    "Status": "В кафке (идет сбор)",
                    "Adres_mikroservisa": "ds_rushydro_damb_level",
                    "Kommentarii": "Изменение уровней водохранилищ ГЭС РусГидро, при наведении на каждую станцию появляется всплывающее окно с данными в текстовом виде (ответственный Беляев).",
                    "Format_dannyh": "",
                    "Otvetstvennyi": "",
                    "Prioritet": "Низкий "
                }
            ]
        },
        "formatting": {
            "steps": [
                {
                    "alias": "first",
                    "elements": [
                        {
                            "type": "group",
                            "children": [
                                {
                                    "type": "group",
                                    "object": "Istochnik/Istochnik",
                                    "size": 12,
                                    "id": "kbuqcr8r",
                                    "children": [
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Nazvanie"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Kod_ChS"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Status"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Otvetstvennyi"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Adres_resursa"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Chastota_obnovleniya_dannyh"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Adres_mikroservisa"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Format_dannyh"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Tematika"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Prioritet"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        },
                                        {
                                            "children": [
                                                {
                                                    "type": "cell",
                                                    "size": 12,
                                                    "children": [
                                                        {
                                                            "type": "field",
                                                            "field": "Istochnik/Istochnik/Kommentarii"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "type": "row"
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ],
            "transition_logic": {
                "first": "first",
                "steps": []
            }
        },
        "version": "1.1",
        "created_at": "07.07.2020 20:17:54"
    }
}
```

## Fail Response

**Code**: `404` 
**Content example**:
```json
    "Work in progress"
```