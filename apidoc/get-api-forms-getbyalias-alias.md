[**<= Back to API**](../README.md)

# Get form by alias
Get form by alias  
**URL** : `/api/forms/getbyalias/{alias}`    
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
                "id": "eb09efa9-256e-4f30-b524-28e0fc03d31b",
                "sort": 0,
                "title": "Задача",
                "alias": "Zadacha",
                "attributes": null,
                "version": "1.1",
                "public": true,
                "objects": [
                    {
                        "id": "d1eef5af-1bf4-4906-924c-04e992388ec6",
                        "alias": "Zadacha",
                        "title": "Задача",
                        "multiple": false,
                        "semantic_subclasses": [],
                        "mask": "%Zadacha%",
                        "updated_at": null,
                        "created_at": "2020-05-28T12:21:15+03:00",
                        "fields": [
                            {
                                "id": "fcf110c6-f5c7-472a-8f7a-5a0561d22ccf",
                                "title": "Описание задачи",
                                "alias": "Opisanie_zadachi",
                                "type": "text",
                                "subtype": "textarea",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "36b72b1d-7129-47c3-a6e0-627646917ed2",
                                "title": "Задача",
                                "alias": "Zadacha",
                                "type": "string",
                                "subtype": "text",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [
                                    {
                                        "class": "required"
                                    }
                                ],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "bce96ee0-e9a9-48a9-85d4-15d80006923b",
                                "title": "Дата окончания задачи",
                                "alias": "Data_okonchaniya_zadachi",
                                "type": "date",
                                "subtype": "date",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "1e437684-09aa-47c1-a2d2-da473fc6aa32",
                                "title": "Файл",
                                "alias": "Fail",
                                "type": "file",
                                "subtype": "file",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "9ffd4c35-e694-45d8-9bd2-ac306ea5e316",
                                "title": "Статус",
                                "alias": "Status",
                                "type": "array",
                                "subtype": "select",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [
                                    {
                                        "class": "required"
                                    },
                                    {
                                        "class": "required"
                                    }
                                ],
                                "settings": {
                                    "values": [
                                        {
                                            "title": "Новая",
                                            "value": "Новая"
                                        },
                                        {
                                            "title": "В работе",
                                            "value": "В работе"
                                        },
                                        {
                                            "title": "Выполнена",
                                            "value": "Выполнена"
                                        },
                                        {
                                            "title": "На проверке",
                                            "value": "На проверке"
                                        },
                                        {
                                            "title": "Возвращена на доработку",
                                            "value": "Возвращена на доработку"
                                        }
                                    ]
                                },
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "d75d4d48-1ac4-4d62-af9e-7ae9f43aa7ee",
                                "title": "Приоритет",
                                "alias": "Prioritet",
                                "type": "array",
                                "subtype": "select",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": {
                                    "values": [
                                        {
                                            "title": "Низкий",
                                            "value": "Низкий"
                                        },
                                        {
                                            "title": "Нормальный",
                                            "value": "Нормальный"
                                        },
                                        {
                                            "title": "Высокий",
                                            "value": "Высокий"
                                        },
                                        {
                                            "title": "Срочный",
                                            "value": "Срочный"
                                        },
                                        {
                                            "title": "Немедленный",
                                            "value": "Немедленный"
                                        }
                                    ]
                                },
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "ef5e35e9-40cc-4ab0-928e-b0068426bcc6",
                                "title": "Проект",
                                "alias": "project",
                                "type": "object",
                                "subtype": "link",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [
                                    {
                                        "class": "required"
                                    }
                                ],
                                "settings": {
                                    "linked_object_type_id": "8b3eef1e-51ac-45f7-a90d-3b5461f5d5b1"
                                },
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "bae9151c-984d-4ae4-9119-760a62d45534",
                                "title": "Ответственный",
                                "alias": "Otvetstvennyi",
                                "type": "object",
                                "subtype": "link",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": {
                                    "linked_object_type_id": "c630742c-0d48-4bb4-b315-3c88127ed090"
                                },
                                "default_value": null,
                                "linkedField": "ef5e35e9-40cc-4ab0-928e-b0068426bcc6"
                            },
                            {
                                "id": "6eff51ef-7cfd-4cba-839f-0addf3ac355e",
                                "title": "Родительская задача",
                                "alias": "Roditelskaya_zadacha",
                                "type": "object",
                                "subtype": "link",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": {
                                    "linked_object_type_id": "82b87a06-17ff-4d5e-8325-e9d3967eb904"
                                },
                                "default_value": null,
                                "linkedField": "ef5e35e9-40cc-4ab0-928e-b0068426bcc6"
                            }
                        ]
                    }
                ],
                "created_at": "25.06.2020 14:31:56"
            },
            "relations": [],
            "values": {
                "Zadacha/Zadacha": [
                    []
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
                                        "object": "Zadacha/Zadacha",
                                        "size": 12,
                                        "id": "kal02ljd",
                                        "children": [
                                            {
                                                "children": [
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Zadacha"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/project"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Roditelskaya_zadacha"
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
                                                                "field": "Zadacha/Zadacha/Data_okonchaniya_zadachi"
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
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Otvetstvennyi"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Status"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Prioritet"
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
                                                        "size": 6,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Fail"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 6,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Zadacha/Zadacha/Opisanie_zadachi"
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
            "created_at": "25.06.2020 14:31:56"
        }
    }
```

## Fail Response

**Condition**: If User is not authorized  
**Code**: `403 forbidden`    
**Content example**:
```json
    {
        "success": false,
        "code": 403,
        "message": "У вас нет доступа для просмотра данной формы",
        "errors": [
            []
        ]
    }
```