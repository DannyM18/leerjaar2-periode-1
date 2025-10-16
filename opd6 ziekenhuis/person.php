    <?php
abstract class Person
{
    private string $name;
    private string $role;

    public function __construct(string $name, string $role)
    {
        $this->name = $name;
        $this->role = $role;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    // Abstracte methode om rol te definiëren
    abstract public function defineRole(): string;
}
?>
