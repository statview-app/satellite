<?php namespace Statview\Satellite\Enums;

enum PostType: string
{
    case Default = 'default';

    case Info = 'info';

    case Danger = 'danger';

    case Warning = 'warning';

    case Success = 'success';

    public function getIcon(): string
    {
        return match($this) {
            self::Default => '📣',
            self::Info => '💁‍♂️',
            self::Danger => '🚨',
            self::Warning => '⚠️',
            self::Success => '✅',
        };
    }
}
