#include <SFML/Graphics.hpp>
#include "RoundedRectangleShape.cpp"
#include "Constants.hpp"
#include "Ball.cpp"

class PoolTable {
private:
    sf::RectangleShape tableShape;
    RoundedRectangleShape borderShape; 
    sf::RectangleShape cushionShape;
    std::vector<sf::CircleShape> pockets;
    float pocketRadius;

    sf::Texture borderTexture;
    sf::Texture cushionTexture;
    sf::Texture tableTexture;

    void setupPockets() {
        std::vector<sf::Vector2f> pocketPositions = {
            {TableBorder - pocketRadius, TableBorder - pocketRadius},            
            {(WindowWidth / 2) - pocketRadius, TableBorder - pocketRadius}, 
            {WindowWidth - TableBorder - pocketRadius, TableBorder - pocketRadius}, 
            {TableBorder - pocketRadius, WindowHeight - TableBorder - pocketRadius}, 
            {(WindowWidth / 2) - pocketRadius, WindowHeight - TableBorder - pocketRadius},
            {WindowWidth - TableBorder - pocketRadius, WindowHeight - TableBorder - pocketRadius} 
        };
        for (const auto& position : pocketPositions) {
            sf::CircleShape pocket(pocketRadius);
            pocket.setFillColor(sf::Color::Black);
            pocket.setPosition(position + sf::Vector2f(OFFSET_X, OFFSET_Y)); // Apply offset
            pockets.push_back(pocket);
        }
    }

public:
    PoolTable() : pocketRadius(25.0f) {
        if (!borderTexture.loadFromFile("D:/SFML KEL 7/bg/border_texture.jpg")) {
        }
        if (!cushionTexture.loadFromFile("D:/SFML KEL 7/bg/cushion_texture.jpg")) {
        }
        if (!tableTexture.loadFromFile("D:/SFML KEL 7/bg/green_texture.jpg")) {
        }

        tableShape.setSize(sf::Vector2f(TableWidth, TableHeight));
        tableShape.setTexture(&tableTexture); 
        tableShape.setPosition(TableBorder + OFFSET_X, TableBorder + OFFSET_Y); 

        // Make the border thicker by increasing its size
        borderShape.setSize(sf::Vector2f(WindowWidth + 40, WindowHeight + 40));
        borderShape.setTexture(&borderTexture); 
        borderShape.setPosition(OFFSET_X - 20, OFFSET_Y - 20); 
        borderShape.setCornersRadius(20.0f); 

        cushionShape.setSize(sf::Vector2f(TableWidth + 40, TableHeight + 40)); // Original size
        cushionShape.setTexture(&cushionTexture); 
        cushionShape.setPosition(TableBorder - 20 + OFFSET_X, TableBorder - 20 + OFFSET_Y); // Original position

        setupPockets();
    }

    void draw(sf::RenderWindow& window) const {
        window.draw(borderShape);
        window.draw(cushionShape);
        window.draw(tableShape);
        for (const auto& pocket : pockets) {
            window.draw(pocket);
        }
    }

    bool isPocketed(Ball& ball) {
        for (const auto& pocket : pockets) {
            sf::FloatRect pocketBounds = pocket.getGlobalBounds();
            if (pocketBounds.contains(ball.getPosition())) {
                return true;
            }
        }
        return false;
    }
};