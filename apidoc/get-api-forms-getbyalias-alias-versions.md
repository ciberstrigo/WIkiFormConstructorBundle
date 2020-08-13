[**<= Back to API**](../README.md)

# Get form version by alias
Get form version and additional information by alias  
**URL** : `/api/forms/getbyalias/{alias}/versions`  
or `GET /api/public/forms/get_by_alias/{alias}/versions`  
**Method**: `GET`   

## Success Response

**Code**: `200 OK`   
**Content example**:
```json
    {
        "success": true,
        "code": 200,
        "message": "",
        "data": [
            {
                "id": "bcf30527-7488-4417-bb5d-66533d7c1edf",
                "title": "Сервис",
                "alias": "Servis",
                "version": "1.1",
                "created_at": "25.06.2020 14:57:50"
            }
        ]
    }
```

## Fail Response

**Code**: `500` 
**Content example**:
```json
    "Work in progress"
```