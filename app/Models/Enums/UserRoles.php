<?php

namespace App\Models\Enums;

/**
 * Class UserRoles
 *
 * The roles that can be assigned to users
 *
 * @package App\Models\Enums
 */
class UserRoles
{
    /**
     * Regular users with access to free tier functionality.
     */
    const REGULAR_CUSTOMER = "REGULAR_CUSTOMER";

    /**
     * Premium users with access to premium functionality.
     */
    const PREMIUM_CUSTOMER = "PREMIUM_CUSTOMER";

    /**
     * Admin user.
     */
    const ADMIN_USER = "ADMIN_USER";

    /**
     * Super admin user.
     */
    const SUPER_ADMIN_USER = "SUPER_ADMIN_USER";
}
