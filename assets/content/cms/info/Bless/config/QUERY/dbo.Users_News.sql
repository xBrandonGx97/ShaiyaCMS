USE [PS_UserData]
GO

/****** Object:  Table [dbo].[Users_News]    Script Date: 12/09/2015 12:22:47 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Users_News](
	[NewsID] [bigint] IDENTITY(1,1) NOT NULL,
	[NewsDate] [smalldatetime] NOT NULL,
	[NewsTitle] [varchar](100) NOT NULL,
	[NewsContent] [varchar](8000) NOT NULL,
	[NewsLink] [varchar](500) NULL,
	[NewsPicURL] [varchar](500) NULL,
	[NewsAuthor] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


