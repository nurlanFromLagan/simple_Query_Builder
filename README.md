# simple_Query_Builder

# Описание

Простой построитель запросов, который поможет вам работать с уже готовыми таблицами в базе данных. С помощью этого компонента вы сможете добавлять, получать, изменять и удалять данные в таблицах.
Подключяется к базе данных через PDO при создании экземпляра классса QueryBuilder.


### 1. Выполняем подключение к БД

```

$db = new QueryBuilder (Connection::make());

```

### 2. Пример использования фунций

```

$params = [
    'task' => 'схожить на тренировку',
    'task_description' => 'Сегодня после работы сходить в зал и хорошо потренироваться'
];

$db->addDb($table, $params); //добавляем данные в таблицу
    
   ->getAll($table); //получаем все данные из таблицы 
   
   ->delete($table, $id); //удаляем данные по id
   
   ....

```
