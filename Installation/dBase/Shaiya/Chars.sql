USE [PS_GameData]
GO

/****** Object:  Table [dbo].[Chars]    Script Date: 12/25/2018 12:40:29 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

ALTER TABLE [dbo].[Chars]
	ADD LoginStatus int NULL,
	faction tinyint NULL;

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_LoginStatus]  DEFAULT ((0)) FOR [LoginStatus]
GO


