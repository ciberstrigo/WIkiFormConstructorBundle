# Submit form
Submit form
**URL** : `/api/forms/{id}/send`    
**Method**: `POST`   
**Data constraints**:   
```json
    "Work in progress"
```
**Data example**:
```json
{
   "kdsnd9ty":{
      "Sobytie/Sobytie":[
         {
            "Fail":[
               "wiki_dev/13-08-2020/016c3ebc-10fb-45e2-8c05-07aec2d25b88-photo.jpg"
            ],
            "Data":"31.08.2020",
            "Tip":"Телефонный звонок",
            "Tema":"Тестовое событие",
            "Uchastniki":[

            ],
            "Rezultat":"Описание тестового события <br>",
            "Region":"21061072-6f43-4739-97ac-6279670b41fd"
         }
      ]
   }
}
```

## Success Response

**Code**: `200 OK`   
**Content example**:
```json
    {
       "success":true,
       "code":200,
       "message":"",
       "data":{

       }
    }
```

## Fail Response

**Code**: `403`   
**Content example**: 
```json
    "Work in progress"
```