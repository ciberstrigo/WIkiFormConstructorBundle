[**<= Back to API**](../README.md)

# Update form
Update form (insert or delete fields) by **{id}**   
**URL** : `/api/forms/{id}`    
**Method**: `PUT`   
**Data constraints**: 
```json
    "Work in progress"
```
**Data example**:
```json
{
   "data":{
      "sort":0,
      "title":"Форма пользователя (тест)",
      "alias":"Forma_polzovatelya_(test)",
      "objects":[
         {
            "id":"06d8d149-781d-4ac5-b618-311745150ea3",
            "alias":"test",
            "title":"test",
            "multiple":false,
            "semantic_subclasses":[

            ],
            "mask":null,
            "updated_at":null,
            "created_at":"2020-08-13 11:27:32",
            "object_type":null,
            "fields":[
               {
                  "title":"Фотография",
                  "alias":"Fotografiya",
                  "type":"file",
                  "subtype":"photo",
                  "read_only":false,
                  "multiple":false,
                  "settings":{

                  },
                  "validation":[

                  ],
                  "semantic_class":"",
                  "object_type_field":null
               }
            ]
         },
         {
            "id":"5e08e07f-6ec1-446f-850d-ba424ff87425",
            "alias":"Interesy",
            "title":"Интересы",
            "multiple":false,
            "semantic_subclasses":[

            ],
            "mask":null,
            "updated_at":null,
            "created_at":"2020-08-13 11:27:32",
            "object_type":null,
            "fields":[

            ]
         }
      ],
      "created_at":null,
      "id":"a4718646-daa9-4013-8205-01432da9609f"
   },
   "values":{
      "Forma_polzovatelya_(test)/test":[
         {
            "Fotografiya":""
         }
      ],
      "Forma_polzovatelya_(test)/Interesy":[
         {

         }
      ]
   },
   "formatting":{
      "steps":[
         {
            "alias":"first",
            "elements":[
               {
                  "type":"group",
                  "children":[
                     {
                        "type":"group",
                        "object":"Forma_polzovatelya_(test)/test",
                        "size":12,
                        "id":"kdsj9s0z",
                        "children":[
                           {
                              "children":[
                                 {
                                    "type":"cell",
                                    "size":4,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/undefined"
                                       }
                                    ]
                                 },
                                 {
                                    "type":"cell",
                                    "size":4,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/undefined"
                                       }
                                    ]
                                 },
                                 {
                                    "type":"cell",
                                    "size":4,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/undefined"
                                       }
                                    ]
                                 }
                              ],
                              "type":"row"
                           },
                           {
                              "children":[
                                 {
                                    "type":"cell",
                                    "size":12,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/Fotografiya"
                                       }
                                    ]
                                 }
                              ],
                              "type":"row"
                           }
                        ]
                     }
                  ]
               }
            ]
         },
         {
            "alias":"Vtoroj_shag",
            "elements":[
               {
                  "type":"group",
                  "children":[
                     {
                        "type":"group",
                        "object":"Forma_polzovatelya_(test)/Interesy",
                        "size":12,
                        "id":"kdsjgzrv",
                        "children":[
                           {
                              "children":[
                                 {
                                    "type":"cell",
                                    "size":12,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/Interesy/undefined"
                                       }
                                    ]
                                 }
                              ],
                              "type":"row"
                           }
                        ]
                     }
                  ]
               }
            ]
         }
      ],
      "transition_logic":{
         "first":"first",
         "steps":{
            "Vtoroj_shag":[
               {
                  "from":"first",
                  "conditions":[

                  ]
               }
            ]
         }
      }
   },
   "version":"1.1",
   "created_at":null
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
      "id":"a4718646-daa9-4013-8205-01432da9609f",
      "sort":0,
      "title":"\u0424\u043e\u0440\u043c\u0430 \u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u044f (\u0442\u0435\u0441\u0442)",
      "alias":"Forma_polzovatelya_(test)",
      "attributes":null,
      "version":"1.1",
      "public":false,
      "objects":[
         {
            "id":"06d8d149-781d-4ac5-b618-311745150ea3",
            "alias":"test",
            "title":"test",
            "multiple":false,
            "semantic_subclasses":[

            ],
            "mask":null,
            "updated_at":null,
            "created_at":"2020-08-13 11:27:32",
            "object_type":null,
            "fields":{
               "4":{
                  "id":"7d7b3cca-79d4-4aca-908a-cd200dfa40fc",
                  "title":"\u0424\u043e\u0442\u043e\u0433\u0440\u0430\u0444\u0438\u044f",
                  "alias":"Fotografiya",
                  "type":"file",
                  "subtype":"photo",
                  "multiple":false,
                  "readOnly":false,
                  "validation":[

                  ],
                  "settings":[

                  ],
                  "default_value":null,
                  "object_type_field":null,
                  "linkedField":null,
                  "visibilityDependsOnField":null
               }
            }
         },
         {
            "id":"5e08e07f-6ec1-446f-850d-ba424ff87425",
            "alias":"Interesy",
            "title":"\u0418\u043d\u0442\u0435\u0440\u0435\u0441\u044b",
            "multiple":false,
            "semantic_subclasses":[

            ],
            "mask":null,
            "updated_at":null,
            "created_at":"2020-08-13 11:27:32",
            "object_type":null,
            "fields":[

            ]
         }
      ],
      "created_at":"13.08.2020 11:43:39"
   }
}
```