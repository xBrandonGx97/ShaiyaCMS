USE [PS_UserData]
GO

/****** Object:  Table [dbo].[UserLoginStatus]    Script Date: 12/26/2018 8:05:02 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[UserLoginStatus](
	[UserUID] [int] NOT NULL,
	[UserIP] [varchar](15) NOT NULL,
	[LoginStatus] [tinyint] NOT NULL,
	[LoginTime] [datetime] NULL,
	[LogoutTime] [datetime] NULL,
	[LoginSession] [bigint] NULL,
	[LogoutSession] [bigint] NULL,
	[LastPlayTime] [int] NULL,
 CONSTRAINT [PK_UserLoginStatus] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, FILLFACTOR = 90) ON [PRIMARY]
) ON [PRIMARY]
GO


