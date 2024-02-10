<?php

namespace App\Traits;

/**
 * Trait Parameters
 *
 * This trait defines common parameters used in various classes.
 * These parameters include keys for titles, descriptions, statuses, IDs, domains, user IDs, names, passwords, etc.
 */
trait Parameters
{
    protected string $title = 'title';
    protected string $description = 'description';
    protected string $status = 'status';
    protected string $websiteId = 'website_id';
    protected string $email = 'email';
    protected string $post = 'post';
    protected string $id = 'id';
    protected string $domain = 'domain';
    protected string $userId = 'user_id';
    protected string $name = 'name';
    protected string $password = 'password';
}
