<?php

namespace src\Helper;

/**
 * Class CommandLineErrorHelper
 * @package src\Helper
 */
class CommandLineErrorHelper
{
    const CATCHALL = 1;
    const COMMAND_INVOKED_CANNOT_EXECUTE = 126;
    const COMMAND_NOT_FOUND = 127;
    const INVALID_ARGUMENT = 128;
    const FATAL_ERROR = 128;
}