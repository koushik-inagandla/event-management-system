-- ============================================
-- EVENT MANAGEMENT SYSTEM DATABASE
-- SQL Server
-- ============================================

CREATE DATABASE eventdb;
GO

USE eventdb;
GO

-- ============================================
-- ADMINS
-- ============================================

CREATE TABLE Admins (
    AdminId INT IDENTITY(1,1) PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);
GO

-- Sample admin account
INSERT INTO Admins (Username, Password)
VALUES ('admin', '123');
GO


-- ============================================
-- CUSTOMERS
-- ============================================

CREATE TABLE Customers (
    CustomerId INT IDENTITY(1,1) PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);
GO


-- ============================================
-- EVENTS
-- ============================================

CREATE TABLE Events (
    EventId INT IDENTITY(1,1) PRIMARY KEY,
    Title VARCHAR(200) NOT NULL,
    Description VARCHAR(MAX),
    Location VARCHAR(200) NOT NULL,
    StartDate DATETIME NOT NULL,
    ImageUrl VARCHAR(500)
);
GO


-- ============================================
-- BOOKINGS
-- ============================================

CREATE TABLE Bookings (
    BookingId INT IDENTITY(1,1) PRIMARY KEY,
    EventId INT NOT NULL,
    CustomerId INT NOT NULL,
    Seats INT NOT NULL,

    CONSTRAINT FK_Bookings_Events
        FOREIGN KEY (EventId)
        REFERENCES Events(EventId),

    CONSTRAINT FK_Bookings_Customers
        FOREIGN KEY (CustomerId)
        REFERENCES Customers(CustomerId)
);
GO


-- ============================================
-- SAMPLE EVENTS
-- ============================================

INSERT INTO Events
    (Title, Description, Location, StartDate, ImageUrl)
VALUES
(
    'Tech Conference 2026',
    'A conference featuring the latest developments in technology and innovation.',
    'Hyderabad',
    '2026-09-15 10:00:00',
    'tech2.jpg'
),
(
    'Music Festival',
    'A live music festival featuring performances from multiple artists.',
    'Hyderabad',
    '2026-10-05 18:00:00',
    'music.jpg'
),
(
    'Art Exhibition',
    'An exhibition showcasing modern and creative artwork.',
    'Hyderabad',
    '2026-10-20 11:00:00',
    'art.jpg'
);
GO