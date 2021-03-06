<?php

namespace FELS\Entities\Observers;

use FELS\Entities\Lesson;

class LessonObserver
{
    /**
     * Hook into lesson deleting event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function deleting(Lesson $lesson)
    {
        $lesson->words()->detach();
    }
}
