# Category Module

    visiosoft.module.category

#### An addon category module and category field type.

### How to use category module

You can use it by adding the following lines to your migration file.

    "user_category" => [
        "type"   => "visiosoft.field_type.category",
        "config" => [
            "level"     => "5", // Shows the subcategory limit
            "related"   => \Anomaly\UsersModule\User\UserModel::class, //Specifies for which stream to add.
        ]
    ]

