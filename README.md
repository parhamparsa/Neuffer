# Architecture of project

The project is designed using a Domain-Driven Design (DDD) architecture, adhering to its core principles to ensure scalability, maintainability, and a clear separation of concerns. It is structured into four main layers:

Application Layer: This layer acts as the intermediary between the domain layer and external systems or user interactions. It orchestrates use cases, coordinates business logic execution, and ensures application workflows align with business requirements.

Domain Layer: The heart of the application, this layer encapsulates the core business logic, rules, and entities. It focuses on the problem domain and remains isolated from external concerns, ensuring that domain models and value objects represent the real-world business context.

Infrastructure Layer: Responsible for technical details, this layer provides implementations for repositories, external service integrations, database interactions, and other supporting functionalities. It bridges the domain layer with external systems while keeping the domain logic unaffected by technical changes.

User Interface Layer: This layer handles interactions with end-users or external systems. It could involve APIs, CLI commands, web interfaces, or any form of user communication. It ensures the seamless delivery of application features to the intended audience.

The architecture promotes a modular design, where each layer has a well-defined role and responsibility, enabling easier testing, refactoring, and adaptability to changing requirements.

# What I do

In this project, I utilized the Strategy Pattern to determine the appropriate operation among the four classes: Addition, Division, Multiplication, and Subtraction. This design choice allows for flexible and maintainable decision-making, ensuring that new operations can be added without modifying existing code. Additionally, I implemented the Factory Pattern to centralize the instantiation of these operation classes, enhancing code readability and adherence to the Open/Closed Principle.

For data management, I leveraged Data Transfer Objects (DTOs) to facilitate structured and efficient data transfer across layers of the application. Moreover, I used Value Objects to represent and encapsulate the core data imported from Excel files, ensuring immutability and consistency within the domain layer.

I developed dedicated Services to handle CSV file operations, including reading, writing, and logging activities. The logging functionality was abstracted through an Interface, enabling the application to support multiple logging mechanisms with ease. This approach ensures flexibility and scalability, as additional logging types can be integrated seamlessly without disrupting existing implementations.

Overall, these design patterns and practices collectively contribute to a clean, modular, and extensible architecture for the project.


# Testing
For testing, I developed comprehensive unit tests for each class within the project to ensure their individual functionality aligns with the expected behavior. This includes verifying the correctness of the logic implemented in the Addition, Division, Multiplication, and Subtraction classes, as well as any supporting components.

In addition, I implemented tests specifically for the Infrastructure Layer to validate its integration with external systems and ensure that critical operations, such as reading, writing, and logging, function seamlessly. These tests provide confidence that the infrastructure components interact correctly with the application and external dependencies, maintaining reliability under various scenarios.

By adopting a thorough testing strategy, I ensured both the core logic and the supporting infrastructure are robust, maintainable, and capable of handling edge cases effectively. This approach contributes to the overall quality and resilience of the project.

# How to test project

You simply need to access the container and execute this command with the specified parameters. Once the command completes, the results will be available in the final folder, containing one text file and one CSV file.

`php ./bin/console csv:import ./src/UserInterface/Cli/test.csv division`