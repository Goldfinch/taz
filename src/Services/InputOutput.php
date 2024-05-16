<?php

namespace Goldfinch\Taz\Services;

use Symfony\Component\Console\Style\SymfonyStyle;

class InputOutput extends SymfonyStyle
{
    public function question(string $question, $default = null, ?callable $validator = null): string
    {
        return $this->ask(sprintf(' ❓  %s', $question), $default, $validator);
    }

    public function right(string $message): void
    {
        $this->block(sprintf(' 🌪️  %s', $message), null, 'fg=white;bg=green', ' ', true);
    }

    public function wrong(string $message): void
    {
        $this->block(sprintf(' 😮  %s', $message), null, 'fg=white;bg=red', ' ', true);
    }

    public function display(string $message): void
    {
        $this->block(
            // sprintf(' 💨  %s', $message),
            $message,
            null,
            'fg=white;bg=yellow',
            ' ',
            true
        );
    }
}
