[**<= Back to API**](../README.md)

# Create form 
Create new form from constructor   
**URL** : `/api/forms/`    
**Method**: `POST`   
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
            "alias":"test",
            "title":"test",
            "multiple":false,
            "object_type":null,
            "semantic_subclasses":[

            ],
            "mask":null,
            "fields":[
               {
                  "title":"Фамилия",
                  "alias":"Familiya",
                  "type":"string",
                  "subtype":"text",
                  "read_only":false,
                  "multiple":false,
                  "settings":{

                  },
                  "validation":[

                  ],
                  "semantic_class":"",
                  "object_type_field":null
               },
               {
                  "title":"Имя",
                  "alias":"Imya",
                  "type":"string",
                  "subtype":"text",
                  "read_only":false,
                  "multiple":false,
                  "settings":{

                  },
                  "validation":[

                  ],
                  "semantic_class":"",
                  "object_type_field":null
               },
               {
                  "title":"Отчество",
                  "alias":"Otchestvo",
                  "type":"string",
                  "subtype":"text",
                  "read_only":false,
                  "multiple":false,
                  "settings":{

                  },
                  "validation":[

                  ],
                  "semantic_class":"",
                  "object_type_field":null
               },
               {
                  "title":"Дата рождения",
                  "alias":"Data_rojdeniya",
                  "type":"date",
                  "subtype":"date",
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
            "alias":"Interesy",
            "title":"Интересы",
            "multiple":false,
            "object_type":null,
            "semantic_subclasses":[

            ],
            "mask":null,
            "fields":[
               {
                  "title":"Интересы",
                  "alias":"Interesy",
                  "type":"string",
                  "subtype":"text",
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
         }
      ],
      "created_at":null
   },
   "relations":[

   ],
   "values":{
      "Forma_polzovatelya_(test)/test":[
         {
            "Familiya":"",
            "Imya":"",
            "Otchestvo":"",
            "Data_rojdeniya":""
         }
      ],
      "Forma_polzovatelya_(test)/Interesy":[
         {
            "Interesy":""
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
                                          "field":"Forma_polzovatelya_(test)/test/Familiya"
                                       }
                                    ]
                                 },
                                 {
                                    "type":"cell",
                                    "size":4,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/Imya"
                                       }
                                    ]
                                 },
                                 {
                                    "type":"cell",
                                    "size":4,
                                    "children":[
                                       {
                                          "type":"field",
                                          "field":"Forma_polzovatelya_(test)/test/Otchestvo"
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
                                          "field":"Forma_polzovatelya_(test)/test/Data_rojdeniya"
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
            "name":"Второй шаг",
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
                                          "field":"Forma_polzovatelya_(test)/Interesy/Interesy"
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