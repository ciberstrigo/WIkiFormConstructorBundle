# Delete form
Delete form
**URL** : `/api/forms/{id}/remove`    
**Method**: `GET`   

## Success Response

**Code**: `200 OK`   
**Content example**:
```json
    {
        "success": true,
        "code": 200,
        "message": "Форма успешно удалена",
        "data": []
    }
```

## Fail Response

**Code**: `403`   
**Content example**:
```json
    "Work in progress"
```