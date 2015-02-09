<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_070815_add_columns_in_project extends Migration
{
    public function up()
    {
        $this->addColumn('project', 'thumb_id', Schema::TYPE_INTEGER);
        $this->addColumn('project', 'thumb_path', Schema::TYPE_STRING);
        $this->addColumn('project', 'active', Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 1');
        $this->addColumn('project', 'description_seo', Schema::TYPE_TEXT.' NOT NULL');
        $this->addColumn('project', 'keywords', Schema::TYPE_TEXT.' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('project', 'keywords');
        $this->dropColumn('project', 'description_seo');
        $this->dropColumn('project', 'active');
        $this->dropColumn('project', 'thumb_path');
        $this->dropColumn('project', 'thumb_id');
    }
}
