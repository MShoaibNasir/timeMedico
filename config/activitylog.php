<?php

<<<<<<< HEAD
use Spatie\Activitylog\Actions\CleanActivityLogAction;
use Spatie\Activitylog\Actions\LogActivityAction;
use Spatie\Activitylog\Models\Activity;

=======
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501
return [

    /*
     * If set to false, no activities will be saved to the database.
     */
<<<<<<< HEAD
    'enabled' => env('ACTIVITYLOG_ENABLED', true),

    /*
     * When the clean command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'clean_after_days' => 365,
=======
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the current Laravel auth driver.
     */
    'default_auth_driver' => null,

    /*
<<<<<<< HEAD
     * If set to true, the subject relationship on activities
     * will include soft deleted models.
     */
    'include_soft_deleted_subjects' => false,
=======
     * If set to true, the subject returns soft deleted models.
     */
    'subject_returns_soft_deleted_models' => false,
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501

    /*
     * This model will be used to log activity.
     * It should implement the Spatie\Activitylog\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     */
<<<<<<< HEAD
    'activity_model' => Activity::class,

    /*
     * These attributes will be excluded from logging for all models.
     * Model-specific exclusions via logExcept() are merged with these.
     */
    'default_except_attributes' => [],

    /*
     * When enabled, activities are buffered in memory and inserted in a
     * single bulk query after the response has been sent to the client.
     * This can significantly reduce the number of database queries when
     * many activities are logged during a single request.
     *
     * Only enable this if your application logs a high volume of activities
     * per request. Buffered activities will not have an ID until the
     * buffer is flushed.
     */
    'buffer' => [
        'enabled' => env('ACTIVITYLOG_BUFFER_ENABLED', false),
    ],

    /*
     * These action classes can be overridden to customize how activities
     * are logged and cleaned. Your custom classes must extend the originals.
     */
    'actions' => [
        'log_activity' => LogActivityAction::class,
        'clean_log' => CleanActivityLogAction::class,
    ],
=======
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */
    'table_name' => env('ACTIVITY_LOGGER_TABLE_NAME', 'activity_log'),

    /*
     * This is the database connection that will be used by the migration and
     * the Activity model shipped with this package. In case it's not set
     * Laravel's database.default will be used instead.
     */
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501
];
