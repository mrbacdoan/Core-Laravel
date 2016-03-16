<?php
/**************************** GLOBAL ****************************/
#Token key
define('TOKEN_KEY', '1d316197f18613dc71e96440f16e90a19189dce3');
#Pagination
define('NUM_PER_PAGE', 15);
define('BACKEND_LANGUAGE_DEFAULT', 'vi');

define('ADMIN_PREFIX', 'Backend');

#Type query
define('WHERE_OR_GROUP', 'WHERE_OR_GROUP');
define('WHERE_AND', 'AND');
define('WHERE_OR', 'OR');
define('WHERE_IN', 'IN');
define('OR_WHERE_IN', 'OR_WHERE_IN');
define('OR_WHERE_NOT_IN', 'OR_WHERE_NOT_IN');
define('WHERE_NOT_IN', 'NOT IN');
define('WHERE_BETWEEN', 'BETWEEN');
define('WHERE_NOT_BETWEEN', 'NOT WHERE_OR');
define('WHERE_NULL', 'NULL');
define('WHERE_DATE', 'WHERE_DATE');
define('WHERE_DAY', 'WHERE_DAY');
define('WHERE_MONTH', 'WHERE_MONTH');
define('WHERE_YEAR', 'WHERE_YEAR');
define('WHERE_RAW', 'WHERE_RAW');
define('WHERE_RAW_OR', 'WHERE_RAW_OR');
define('ORDER_BY', 'ORDER BY');
define('GROUP_BY', 'GROUP_BY');
define('LIMIT', 'LIMIT');
define('SKIP', 'SKIP');
define('TAKE', 'TAKE');
define('MIN', 'MAX');
define('MAX', 'MAX');
define('INCREMENT', 'INCREMENT');
define('DECREMENT', 'DECREMENT');

#Status
define('STATUS_ACTIVATED', 1);
define('STATUS_DEACTIVATED', 0);
define('STATUS_PENDING', 2);
define('STATUS_DELETE', -1);
define('STATUS_FINISH', 3);

define('AJAX_VALIDATOR_FAILED', 422);
define('AJAX_SUCCESS', 200);
define('AJAX_FAILED', 0);
define('AJAX_INFO', 55);
define('AJAX_WARNING', 50);
define('CREATED_SUCCESS', 200);
define('CREATED_FAILED', 0);
define('UPDATED_SUCCESS', 200);
define('UPDATED_FAILED', 0);
define('DELETED_SUCCESS', 200);
define('DELETED_FAILED', 0);

define('AJAX_VERIFY_IN_VALID', 100);
define('REGISTER_SOCIAL_SUCCESS', 101);
define('AJAX_USER_DEACTIVATED', 4);
define('PROVIDER_FACEBOOK', 'facebook');
define('PROVIDER_GOOGLE', 'google_plus');


/**************************** PROJECT ****************************/
define('API_PREFIX', 'api/v1');
define('API_PREFIX_ADMIN', 'api/v1/admin');
define('API_PREFIX_ENTERPRISE', 'api/v1/enterprise');
define('USER_TYPE_ADMIN', 'admin');

define('BACKEND_PREFIX', 'backend');

#User
define('USER_ACTIVATED', 1);
define('USER_DEACTIVATED', 0);
define('USER_ACTIVE_DEFAULT', USER_ACTIVATED);
define('USER_GROUP_DEFAULT', 0);
define('USER_STATUS_DEFAULT', 1);
define('USER_STATUS_BAN', 2);

# CONSTANT FOR UPLOAD FILE
define('PATH_UPLOAD_THUMB_NEWS', 'uploads/news/thumbnails/');
define('PATH_UPLOAD_DEFAULT', 'uploads/defaults/');
define('PATH_UPLOAD_AVATAR', 'uploads/avatars/');

define('PATH_UPLOAD_HERITAGE_THUMBNAILS', 'uploads/heritages/thumbnails/');
define('PATH_UPLOAD_POSTS', 'uploads/posts/');
define('PATH_UPLOAD_HERITAGE_COVERS', 'uploads/heritages/covers/');
define('PATH_UPLOAD_VIDEOS', 'uploads/medias/');
define('PATH_UPLOAD_MEDIAS', 'uploads/medias/');
define('PATH_UPLOAD_SLIDERS', 'uploads/sliders/');
define('PATH_UPLOAD_ALBUMS', 'uploads/albums/');
define('PATH_UPLOAD_IMAGES', 'uploads/images/');
define('PATH_UPLOAD_THUMBNAILS', 'uploads/thumbnails/');
define('PATH_UPLOAD_ADVERTISEMENTS', 'uploads/advertisements/');


define('GENDER_MALE', 1);
define('GENDER_FEMALE', 2);
define('GENDER_OTHER', 3);
define('MAX_COUNT_CODE', 3);


define('BASE_VIEWER_URL', 'https://docs.google.com/viewer?url=');


#Cache
define('CORE_CACHE_GROUP', 'CORE_CACHE_GROUP');
define('CORE_CACHE_ROLE', 'CORE_CACHE_ROLE');

define('CACHE_ADVERTISEMENT', 'adv');


#Location
define('ADDRESS_AREA', 'AREA');
define('LOCATION_AREA', 'AREA');
define('LOCATION_PROVINCE', 'PROVINCE');

#lang
define('LANG_VI', 'vi');

#advertisements
define('ADVERTISEMENT_TYPE_IMAGE', 'image');
define('ADVERTISEMENT_TYPE_HTML', 'html');
define('ADVERTISEMENT_POSITION_SIDEBAR_RIGHT', 'sidebar_right');

#config
define('CONFIG_DEFAULT_ID', 'default');
define('CONFIG_LOCALE', 'locale');

#sex
define('SEX_MALE', 1);
define('SEX_FEMALE', 2);

# user permission
define('GROUP_ADMIN', 1);
define('GROUP_USER', 2);

# path avatar
define('USER_AVATAR_PATH', 'uploads/avatars/');

#link avatar default
define('USER_AVATAR_DEFAULT', 'uploads/avatars/user-avatar-default.png');