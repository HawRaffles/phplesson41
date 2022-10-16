
<?php
class Manager
{
    public string $name, $surname;
    public int $age;
    public int $salary;
    private static int $increaseValue = 1000;

    public function __construct(string $name, string $surname, int $age)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->salary = 10000;
    }

    public function __clone(): void
    {
        $this->salary += self::$increaseValue;
    }

    public function __serialize(): array
    {
        return [
            'Manager Name' => $this->name,
            'Manager Surname' => $this->surname,
            'Manager age' => $this->age,
            'Salary' => $this->salary
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name = $data['Manager Name'];
        $this->surname = $data['Manager Surname'];
        $this->age = $data['Manager age'];
        $this->salary = $data['Salary'];
    }

}

$juniorManager = new Manager('Taras', 'Kizuma', '33');
$dataToSaveDB = serialize($juniorManager);
echo 'Інформація щодо молодшого менеджера' . PHP_EOL;
print_r($juniorManager);

$seniorManager = clone $juniorManager;
$dataToSaveDB = serialize($seniorManager);
echo 'Інформація щодо старшого менеджера' . PHP_EOL;
print_r($seniorManager);

$objectData = unserialize($dataToSaveDB);