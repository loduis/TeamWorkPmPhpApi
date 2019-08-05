<?php

function rand_string($string, $length = 10)
{
    $source  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return $string . ' - ' . substr(str_shuffle($source), 0, $length);
}

/**
 * Grab the first project id for the project with the option of only returning active projects
 *
 * @param string $project_status
 * @return int
 */
function get_first_project_id($project_status = '')
{
    static $id = null;
    if ($id === null) {
        $project = TeamWorkPm\Factory::build('project');
        foreach($project->getAll() as $p) {
            if (!empty($project_status) && $p->status != $project_status) {
                continue;
            }
            $id = $p->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_project_category_id()
{
    static $id = null;
    if ($id === null) {
        $category = TeamWorkPm\Factory::build('category/project');
        foreach($category->getAll() as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_link_category_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $category = TeamWorkPm\Factory::build('category/link');
        foreach($category->getByProject($project_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_file_category_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $category = TeamWorkPm\Factory::build('category/file');
        foreach($category->getByProject($project_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_notebook_category_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $category = TeamWorkPm\Factory::build('category/notebook');
        foreach($category->getByProject($project_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_message_category_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $category = TeamWorkPm\Factory::build('category/message');
        foreach($category->getByProject($project_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}



function get_first_person_id($project_id = null)
{
    static $id = null;
    if ($id === null) {
        $people = TeamWorkPm\Factory::build('people');
        $method = $project_id ? 'getByProject' : 'getAll';
        foreach($people->$method($project_id) as $p) {
            $id = $p->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_milestone_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $milestone = TeamWorkPm\Factory::build('milestone');
        foreach($milestone->getByProject($project_id) as $m) {
            $id = $m->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_message_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $message = TeamWorkPm\Factory::build('message');
        foreach($message->getByProject($project_id) as $m) {
            $id = $m->id;
            break;
        }
    }
    return (int) $id;
}



function get_first_file_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $file = TeamWorkPm\Factory::build('file');
        foreach($file->getByProject($project_id) as $f) {
            $id = $f->id;
            break;
        }
    }
    return (int) $id;
}

/*
function get_first_file_version_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $milestone = TeamWorkPm\Factory::build('file');
        foreach($milestone->getByProject($project_id) as $f) {
            $id = $f->versionId;
            break;
        }
    }
    return (int) $id;
}*/


function get_first_task_list_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $list = TeamWorkPm\Factory::build('task/list');
        foreach($list->getByProject($project_id) as $t) {
            $id = $t->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_task_id($task_list_id)
{
    static $id = null;
    if ($id === null) {
        $task = TeamWorkPm\Factory::build('task');
        foreach($task->getByTaskList($task_list_id) as $t) {
            $id = $t->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_time_id($task_id)
{
    static $id = null;
    if ($id === null) {
        $time = TeamWorkPm\Factory::build('time');
        foreach($time->getByTask($task_id) as $t) {
            $id = $t->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_link_id()
{
    static $id = null;
    if ($id === null) {
        $link = TeamWorkPm\Factory::build('link');
        $links = $link->getAll();
        foreach($links as $l) {
            $id = $l->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_company_id()
{
    static $id = null;
    if ($id === null) {
        $company = TeamWorkPm\Factory::build('company');
        $companies = $company->getAll();
        foreach($companies as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_milestone_comment_id($milestone_id)
{
    static $id = null;
    if ($id === null) {
        $comment      = TeamWorkPm\Factory::build('comment/milestone');
        foreach ($comment->getRecent($milestone_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_task_comment_id($task_id)
{
    static $id = null;
    if ($id === null) {
        $comment      = TeamWorkPm\Factory::build('comment/task');
        foreach ($comment->getRecent($task_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_file_comment_id($file_id)
{
    static $id = null;
    if ($id === null) {
        $comment      = TeamWorkPm\Factory::build('comment/file');
        foreach ($comment->getRecent($file_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}



function get_first_notebook_comment_id($notebook_id)
{
    static $id = null;
    if ($id === null) {
        $comment      = TeamWorkPm\Factory::build('comment/notebook');
        foreach ($comment->getRecent($notebook_id) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

function get_first_notebook_id($project_id)
{
    static $id = null;
    if ($id === null) {
        $notebook = TeamWorkPm\Factory::build('notebook');
        foreach($notebook->getByProject($project_id) as $n) {
            $id = $n->id;
            break;
        }
    }
    return (int) $id;
}

/**
 * Grab the ID of the first portfolio board
 *
 * @return int
 */
function get_first_portfolio_board_id()
{
    static $id = null;
    if ($id === null) {
        $portfolioBoard = TeamWorkPm\Factory::build('portfolio/board');
        foreach($portfolioBoard->getAll() as $b) {
            $id = $b->id;
            break;
        }
    }
    return (int) $id;
}

/**
 * Grab the ID of the first portfolio board column id
 *
 * @param int $boardId
 *
 * @return int
 */
function get_first_portfolio_board_column_id($boardId)
{
    static $id = null;
    if ($id === null) {
        $portfolioColumn = TeamWorkPm\Factory::build('portfolio/column');
        foreach($portfolioColumn->getAllForBoard($boardId) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}

/**
 * Grab the ID of the first card in the given column
 *
 * @param int $columnId
 *
 * @return int
 */
function get_first_portfolio_card_id($columnId)
{
    static $id = null;
    if ($id === null) {
        $portfolioCard = TeamWorkPm\Factory::build('portfolio/card');
        foreach($portfolioCard->getAllForColumn($columnId) as $c) {
            $id = $c->id;
            break;
        }
    }
    return (int) $id;
}
