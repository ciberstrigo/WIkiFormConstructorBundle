# Get forms
Get all of forms created by constructor  
**URL** : `/api/forms/`    
**Method**: `GET`

## Success Response

**Code**: `200 OK`   
**Content examples**:
```json
{
    "success": true,
    "code": 200,
    "message": "",
    "data": [
        {
            "id": "eb09efa9-256e-4f30-b524-28e0f2dc931b",
            "title": "Задача",
            "alias": "Zadacha",
            "version": "1.1",
            "created_at": "25.06.2020 14:31:56"
        },
        {
            "id": "032dc9b8-bf20-5fr4-8c5d-d547f142d7a9",
            "title": "Источник",
            "alias": "Istochnik",
            "version": "1.2",
            "created_at": "02.07.2020 20:17:54"
        },
        {
            "id": "bd52dc97-32b7-463e-abcc-57fc8f3ede11",
            "title": "Организация",
            "alias": "Organizaciya",
            "version": "1.1",
            "created_at": "22.07.2020 16:29:25"
        },
        {
            "id": "20c4325f-22d8-4ee2-2dc9-90597b2135d1",
            "title": "Персона",
            "alias": "Persona",
            "version": "1.1",
            "created_at": "28.07.2020 19:19:45"
        },
        {
            "id": "bed72dc9-f181-403d-982e-a80a87ba942b",
            "title": "Проект",
            "alias": "Proekt",
            "version": "1.1",
            "created_at": "23.07.2020 19:15:14"
        }
    ]
}
```