## Задача "PHP" В папке FileManager_php
![FileManager_php](http://dl4.joxi.net/drive/2024/06/02/0031/2220/2087084/84/cac1ef636d.jpg)
## Задача "Верстка" В папке LoginForm_bootstrap
![Верстка](http://dl4.joxi.net/drive/2024/06/02/0031/2220/2087084/84/bf87103008.jpg)
## Задача "MySQL" В папке MySQL

### Создать Tables
```sql 
 -- Create Types tables
CREATE TABLE Types (
            id INT PRIMARY KEY,
            Name VARCHAR(100)
);

-- Create Motorcycles
CREATE TABLE Motorcycles (
            id INT PRIMARY KEY,
            Name VARCHAR(100),
            type_id INT NULL,
            status BOOLEAN,
            FOREIGN KEY (type_id) REFERENCES Types(id) ON DELETE SET NULL ON UPDATE CASCADE
);


-- Insert Types
INSERT INTO Types (id, Name) VALUES
            (1, 'Sport'),
            (2, 'Cruiser'),
            (3, 'Classic');

-- Insert Motorcycles
INSERT INTO Motorcycles (id, Name, type_id, status) VALUES
            (1, 'Ducati Panigale V4', 1, FALSE),
            (2, 'Harley-Davidson Street 750', 1, TRUE),
            (3, 'BMW S1000RR', 2, TRUE),
            (4, 'Triumph Bonneville', 1, TRUE);
 ```

## Запрос выборки из БД
### Кол-во мотоциклов в каждом типе c учетом статуса.

```sql
SELECT t.name AS Type,
       COUNT(m.id) AS MotorcycleCount
FROM Types t
LEFT JOIN Motorcycles m ON t.id = m.type_id AND m.status = 1
GROUP BY t.name;
```
## Результат
| Type   | MotorcycleCount |
|---------|:---------------:|
| Sport |        2        |
| Cruiser |        1        |
| Classic |        0        |

