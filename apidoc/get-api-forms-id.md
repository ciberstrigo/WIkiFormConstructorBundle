[**<= Back to API**](README.md)

# Get form by id
Get form information created by constructor by id  
**URL** : `/api/forms/{id}`    
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
                "id": "77cc222d-d919-45d7-a828-924ea917680f",
                "sort": 0,
                "title": "Событие",
                "alias": "Sobytie",
                "attributes": null,
                "version": "1.1",
                "public": true,
                "objects": [
                    {
                        "id": "aa5c02ad-19cd-459d-adc7-d179893be5eb",
                        "alias": "Sobytie",
                        "title": "Событие",
                        "multiple": false,
                        "semantic_subclasses": [],
                        "mask": "%Tema%",
                        "updated_at": null,
                        "created_at": "2020-05-25T15:01:18+03:00",
                        "fields": [
                            {
                                "id": "cd34d240-50f3-4220-b893-664140885bf6",
                                "title": "Файл",
                                "alias": "Fail",
                                "type": "file",
                                "subtype": "file",
                                "multiple": true,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "3660515a-9a70-478a-a4bc-05e6817e4cb1",
                                "title": "Дата",
                                "alias": "Data",
                                "type": "date",
                                "subtype": "date",
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
                                "id": "9f904021-25a3-4f06-b59f-6c7a772d1d93",
                                "title": "Тип",
                                "alias": "Tip",
                                "type": "array",
                                "subtype": "select",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": {
                                    "values": [
                                        {
                                            "title": "Совещание",
                                            "value": "Совещание"
                                        },
                                        {
                                            "title": "ВКС",
                                            "value": "ВКС"
                                        },
                                        {
                                            "title": "Телефонный звонок",
                                            "value": "Телефонный звонок"
                                        }
                                    ]
                                },
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "49910e9c-a245-4821-bd01-b49cb95c7152",
                                "title": "Тема",
                                "alias": "Tema",
                                "type": "string",
                                "subtype": "text",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "1a52b550-9e95-499d-803c-71f70281a275",
                                "title": "Участники",
                                "alias": "Uchastniki",
                                "type": "object",
                                "subtype": "link",
                                "multiple": true,
                                "readOnly": false,
                                "validation": [],
                                "settings": {
                                    "linked_object_type_id": "c630742c-0d48-4bb4-b315-3c88127ed090"
                                },
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "e67c84a5-90bb-4c3b-b912-921f06097b62",
                                "title": "Результат",
                                "alias": "Rezultat",
                                "type": "string",
                                "subtype": "text",
                                "multiple": false,
                                "readOnly": false,
                                "validation": [],
                                "settings": [],
                                "default_value": null,
                                "linkedField": null
                            },
                            {
                                "id": "82d483bc-f518-4ef2-8163-967bff7c5ac0",
                                "title": "Проект",
                                "alias": "Project",
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
                            }
                        ]
                    }
                ],
                "created_at": "25.06.2020 14:33:16"
            },
            "relations": [],
            "values": {
                "Sobytie/Sobytie": [
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
                                        "object": "Sobytie/Sobytie",
                                        "size": 12,
                                        "id": "kal0965y",
                                        "children": [
                                            {
                                                "children": [
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Sobytie/Sobytie/Tema"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Sobytie/Sobytie/Data"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 4,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Sobytie/Sobytie/Tip"
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
                                                                "field": "Sobytie/Sobytie/Rezultat"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 6,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Sobytie/Sobytie/Fail"
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
                                                                "field": "Sobytie/Sobytie/Project"
                                                            }
                                                        ]
                                                    },
                                                    {
                                                        "type": "cell",
                                                        "size": 6,
                                                        "children": [
                                                            {
                                                                "type": "field",
                                                                "field": "Sobytie/Sobytie/Uchastniki"
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
            "created_at": "25.06.2020 14:33:16"
        }
    }
```

## Fail Response

**Code**: `500` 
**Content example**:
```json
    "Work in progress"
```