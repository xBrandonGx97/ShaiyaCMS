USE [ShaiyaCMS]
GO

/****** Object:  Table [dbo].[LOOT_BOX_ITEMS]    Script Date: 1/5/2019 2:08:42 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LOOT_BOX_ITEMS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemName] [varchar](50) NOT NULL,
	[ItemDescription] [varchar](500) NOT NULL,
	[ItemIconUrl] [text] NOT NULL,
	[ItemCount] [int] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO


USE [ShaiyaCMS]
GO

/****** Object:  Table [dbo].[LOOT_BOX_ITEMS_PENDING]    Script Date: 1/5/2019 2:08:45 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LOOT_BOX_ITEMS_PENDING](
	[UserUID] [int] NOT NULL,
	[ID] [varchar](50) NOT NULL
) ON [PRIMARY]
GO


USE [ShaiyaCMS]
GO

/****** Object:  Table [dbo].[LOOT_BOX_LOGS]    Script Date: 1/5/2019 2:08:51 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LOOT_BOX_LOGS](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemCount] [int] NOT NULL,
	[Date] [smalldatetime] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[LOOT_BOX_LOGS] ADD  CONSTRAINT [DF_LootBoxLog_Date]  DEFAULT (getdate()) FOR [Date]
GO


USE [ShaiyaCMS]
GO

/****** Object:  Table [dbo].[LOOT_BOX_TIME]    Script Date: 1/5/2019 2:08:55 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[LOOT_BOX_TIME](
	[UserUID] [int] NOT NULL,
	[LootBoxTime] [varchar](max) NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
