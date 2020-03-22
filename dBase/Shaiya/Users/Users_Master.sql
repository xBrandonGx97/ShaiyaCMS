USE [PS_UserData]
GO

/****** Object:  Table [dbo].[Users_Master]    Script Date: 12/25/2018 12:36:58 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

ALTER TABLE [dbo].[Users_Master]
	ADD [Exception] [int] NULL;

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_Exception]  DEFAULT ((0)) FOR [Exception]
GO

