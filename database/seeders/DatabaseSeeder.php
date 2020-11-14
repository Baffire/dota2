<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::create([
            'id' => 1,
            'user_id' => 0,
            'title' => 'Призовой фонд The International 2020 достиг отметки в 39 млн долларов',
            'body' => '
<div>
    <p>Рекордный призовой фонд в истории киберспорта превысил отметку в 39 миллионов долларов США спустя 126 дней и 10 часов от начала продаж Battle Pass. 25% выручки добавляется к стартовым $1,6 млн. Сборы должны были закончиться 19-го сентября, на Valve продлила действие Боевого Пропуска на три недели.</p>
    <p>В случае, если до 9-го октября сообществу удастся покорить отметку в 40 миллионов долларов, все владельцы Battle Pass получат награду в размере 10 000 боевых очков.</p>
</div>
',
        ]);
        
        \App\Models\Comment::create([
            'id' => 1,
            'post_id' => 1,
            'parent_id' => null,
            'user_nickname' => 'Зашквардер',
            'body' => 'Поддержим молодую индикомпанию',
            'like' => 5,
            'dislike' => 2,
        ]);
        \App\Models\Comment::create([
            'id' => 2,
            'post_id' => 1,
            'parent_id' => 1,
            'user_nickname' => 'BolshoiDlinnuiNeobrezanui',
            'body' => 'И так как ти10 нет. Все пойдет гейбу в карман на бургеры, яхты и куртизанок. А вы и дальше пяльтесь на 2д врку.',
            'like' => 15,
            'dislike' => 22,
        ]);
        
        \App\Models\Comment::create([
            'id' => 3,
            'post_id' => 1,
            'parent_id' => null,
            'user_nickname' => 'SoulSolo',
            'body' => 'Гейбу на разработку халвы 3(но ее никогда не будет)',
            'like' => 4,
            'dislike' => 4,
        ]);
        \App\Models\Comment::create([
            'id' => 4,
            'post_id' => 1,
            'parent_id' => 3,
            'user_nickname' => 'Sociopath71',
            'body' => 'Тем временем в валв: "ну это значит ещё полгода можно ничего не делать"',
            'like' => 11,
            'dislike' => 0,
        ]);
        \App\Models\Comment::create([
            'id' => 5,
            'post_id' => 1,
            'parent_id' => 3,
            'user_nickname' => 'Apple hellcasecom',
            'body' => 'Всё больше понимаю, что хомяки никогда не вымрут. Рейтинговый сезон уже больше года идёт, когда обещали на полгода, сундуки - какие-то помои из Workshop',
            'like' => 2,
            'dislike' => 3,
        ]);
    }
}
