<?php

/**
 * Define constants for what to do if the access-control is not specified
 * for a particular route, If we're in FAIL_OPEN mode we'll allow the request to continue
 * as if the route is not protected.
 *
 * If we're in FAIL_CLOSED mode the request will be rejected.
 */
const MISSING_ACL_ENTRY_FAIL_OPEN = true;
const MISSING_ACL_ENTRY_FAIL_CLOSED = false;

return [
    'missing-access-control-behaviour' => MISSING_ACL_ENTRY_FAIL_CLOSED
];
